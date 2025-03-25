<style>

.readable-font {
    font-family: 'Verdana', sans-serif; 
}

.readable-font h1, .readable-font h2, .readable-font h3, .readable-font h4, .readable-font h5 {
    font-family: 'Verdana', sans-serif;
}

.readable-font p, .readable-font li, .readable-font a {
    font-family: 'Verdana', sans-serif;
}

#google_translate_element {
    display: none; /* Initially hidden */
}
/* Accessibility Button */
#accessibility-btn {
    position: fixed;
    bottom: 50px;
    left: 0;
    background-color: rgb(233, 126, 32);
    color: white;
    padding: 15px;
    font-size: 20px;
    border: none;
    border-radius: 0;
    cursor: pointer;
    z-index: 1002;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease-out;
}

/* Dropdown Menu Adjustments */
#accessibility-dropdown {
    position: fixed;
    bottom: 50px;
    left: 0;
    transform: translateX(-100%);
    width: 180px;  
    background-color: white;
    border: 1px solid rgb(233, 126, 32);
    border-radius: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1001;
    transition: transform 0.3s ease-out;
    padding: 10px;
    overflow: hidden;
}

/* Styling for the header in the dropdown */
#accessibility-dropdown h3 {
    text-align: center;
    margin-top: 0;
    color: black;
    font-size: 15px;
    font-weight: bold;
    padding-top: 10px; 
}

/* Buttons inside dropdown */
#accessibility-dropdown button {
    background-color: white;
    color:rgb(233, 126, 32);
    border: 1px solid rgba(233, 126, 32, 0.65);
    padding: 5px 5px 5px 5px;
    cursor: pointer;
    width: 100%;
    font-size: 13px;
    text-align: center;
    margin-bottom: 5px; /* Space between buttons */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

#accessibility-dropdown button.active {
    background-color: rgb(233, 126, 32);
    color:#FFFFFF;
    transition: transform 0.3s ease-out;
}

#accessibility-dropdown button:hover {
    background-color: rgb(233, 126, 32);
    color:#FFFFFF;
    transition: transform 0.3s ease-out;
}


    .visitor-counter {
        margin-top: 10px;
        text-align: center;
        color: #fff;
    }

    #hello img {
        position: fixed;
        right: 0;
        bottom: 0;
        width: 131px;
        z-index: 999;
    }

    #contact {
        right: 80px;
        bottom: 40px;
        z-index: 9999;
    }
</style>
<?php
// Nama file untuk menyimpan data pengunjung
$file = "pengunjung_data.json";
$backup_file = "backup_pengunjung_data_" . date("Ymd") . ".json";
$log_file = "log_reset.txt";

// Fungsi untuk membaca atau membuat file jika belum ada
function readFileOrCreate($filename, $default_value = []) {
    if (!file_exists($filename)) {
        file_put_contents($filename, json_encode($default_value, JSON_PRETTY_PRINT));
    }
    return json_decode(file_get_contents($filename), true);
}

// Ambil data dari file
$data = readFileOrCreate($file);

// Backup otomatis jika data masih ada
if (!file_exists($backup_file) && !empty($data)) {
    file_put_contents($backup_file, json_encode($data, JSON_PRETTY_PRINT));
}

// Jika file JSON kosong atau tidak terbaca, catat log dan gunakan backup
if (empty($data) || !isset($data['total'])) {
    file_put_contents($log_file, date("Y-m-d H:i:s") . " - Data reset terdeteksi. Menggunakan backup jika tersedia.\n", FILE_APPEND);
    $data = readFileOrCreate($backup_file, [
        'total' => 0, 'daily' => [], 'monthly' => [], 'yearly' => [], 'sessions' => []
    ]);
}

// Tanggal, bulan, dan waktu saat ini
$current_date = date("Y-m-d");
$current_month = date("Y-m");
$current_year = date("Y");
$current_time = time();

// Inisialisasi data jika belum ada
if (!isset($data['total'])) $data['total'] = 0;
if (!isset($data['daily'][$current_date])) $data['daily'][$current_date] = 0;
if (!isset($data['monthly'][$current_month])) $data['monthly'][$current_month] = 0;
if (!isset($data['yearly'][$current_year])) $data['yearly'][$current_year] = 0;
if (!isset($data['sessions'])) $data['sessions'] = [];

// Tambahkan pengunjung baru (hanya untuk pengunjung unik dalam sesi ini)
session_start();
if (!isset($_SESSION['visitor_id'])) {
    $_SESSION['visitor_id'] = uniqid();
    $data['total']++;
    $data['daily'][$current_date]++;
    $data['monthly'][$current_month]++;
    $data['yearly'][$current_year]++;
}

// Update waktu aktivitas terakhir untuk sesi saat ini
$data['sessions'][$_SESSION['visitor_id']] = $current_time;

// Hapus sesi yang dianggap "offline" (tidak aktif lebih dari 10 menit)
$timeout = 600; // 10 menit
foreach ($data['sessions'] as $session_id => $last_activity) {
    if ($current_time - $last_activity > $timeout) {
        unset($data['sessions'][$session_id]);
    }
}

// Hitung jumlah pengunjung online
$data['online'] = count($data['sessions']);

// Simpan data ke file
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
?>

<!-- Start Footer -->
<footer class="bg-dark default-padding-top text-light">
    <div class="container">
        <div class="row">
            <div class="f-items">
                <div class="col-md-3 item">
                    <div class="f-item">
                        <h4>Kontak Kami</h4>
                        <p><i class="fas fa-phone" style="margin-right: 10px"></i> {{\App\Models\Attribute::getAttr('phone')}}</p>
                        <p><i class="fas fa-home" style="margin-right: 10px"></i> {{\App\Models\Attribute::getAttr('address')}}</p>
                        <p><i class="fas fa-envelope" style="margin-right: 10px"></i> {{\App\Models\Attribute::getAttr('email')}}</p>
                        <p><i class="fas fa-globe" style="margin-right: 10px"></i> {{env('APP_URL')}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="f-item link">
                        <h4>Statistik Pengunjung</h4>
                        <p class='text-white' style='margin-bottom: 15px;'>Online: <?= $data['online'] ?> Pengunjung</p>
                        <p class='text-white' style='margin-bottom: 15px;'>Hari Ini: <?= $data['daily'][$current_date] ?> Pengunjung</p>
                        <p class='text-white' style='margin-bottom: 15px;'>Bulan Ini: <?= $data['monthly'][$current_month] ?> Pengunjung</p>
                        <p class='text-white'>Tahun Ini: <?= $data['yearly'][$current_year] ?> Pengunjung</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="f-item link">
                        <h4>Situs Terkait</h4>
                        <ul style="height: 200px; max-height: 200px; overflow-y: scroll;">
                            @foreach (footerLink() as $item)
                            <li><a target="_blank" href="{{asset($item['link'])}}">{{$item['name']}} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 item">
                    <div class="f-item address">
                        <h4>Sosial Media</h4>
                        <ul>
                            <li>
                                <a href="{{\App\Models\Attribute::getAttr('instagram')}}"><i class="fab fa-instagram"></i> </a>
                                <a href="{{\App\Models\Attribute::getAttr('facebook')}}"><i class="fab fa-facebook"></i> </a>
                                <a href="{{\App\Models\Attribute::getAttr('youtube')}}"><i class="fab fa-youtube"></i> </a>
                                <a href="{{\App\Models\Attribute::getAttr('twitter')}}"><i class="fab fa-twitter"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <p>&copy; Hak Cipta 2023. Semua hak dilindungi oleh <a href="{{env('APP_URL')}}">{{env('APP_ORG')}}</a></p>
                    </div>
                    <div class="col-md-6 text-right link">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</footer>
<!-- End Footer -->

<!-- Tombol Aksesibilitas -->
<div id="accessibility-btn" class="accessibility-btn">
    <i class="fas fa-wheelchair"></i>
</div>
<div id="accessibility-dropdown" class="accessibility-dropdown">
    <h3>Fitur Aksesibilitas</h3>
    <button id="start-speech" onclick="toggleSpeech()">Aktifkan Text-to-Speech</button>
    <button id="translate-to-english" onclick="toggleTranslate()">Terjemahkan</button>
    <button id="grayscale" onclick="toggleGrayscale()">Grayscale</button>
    <button id="readable-font" onclick="toggleReadableFont()">Readable Font</button>
</div>

<!-- Widget Google Translate -->
<div id="google_translate_element" style="position: fixed; left: 0; top: 50%; transform: translateY(-50%); z-index: 1001; background-color: #ffffff; padding: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); border-radius: 5px; display: none;">
</div>


        <div id="hello">
            <img src="{{asset('web/assets/img/kejati/cs.png')}}" alt="">
        </div>
        
        <div id="contact" class="arcontactus-widget arcontactus-message right lg active">
        
            <div class="messangers-block lg">
                <a class="messanger " href="https://api.whatsapp.com/send?phone={{ \App\Models\Attribute::getAttr('chat1') }}" target="_blank">
                    <span style="background-color:#4EB625">
                        <i class="fab fa-whatsapp"></i>
                    </span>
                    <p>Hotline Pelayanan Hukum Pengaduan Masyarakat dan Pengaduan Mafia Tanah</p>
                </a>
                <a class="messanger " href="https://api.whatsapp.com/send?phone=6282161900706" target="_blank">
                    <span style="background-color:#4EB625">
                        <i class="fab fa-whatsapp"></i>
                    </span>
                    <p>Hotline Pengaduan Masyarakat Online dengan SILAWAS (Sistem Laporan Whatsapp)</p>
                </a>
            </div>
        
            <div class="arcontactus-message-button" style="background-color: #ff0000">
                <div class="static">
                    <svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Canvas" transform="translate(-825 -308)">
                            <g id="Vector">
                                <use xlink:href="#path0_fill0123" transform="translate(825 308)" fill="#FFFFFF"></use>
                            </g>
                        </g>
                        <defs>
                            <path id="path0_fill0123" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"></path>
                        </defs>
                    </svg>
                    <p>Hubungi</p>
                </div>
        
                <div class="pulsation" style="background-color: #df0000"></div>
                <div class="pulsation" style="background-color: #df0000"></div>
            </div>
        
        </div>
        
<!-- Accessibility JavaScript -->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=a4S8rNcj"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById('accessibility-btn');
    const dropdown = document.getElementById('accessibility-dropdown');
    const speechBtn = document.getElementById("start-speech");
    const translateBtn = document.getElementById("translate-to-english");
    const grayscaleBtn = document.getElementById("grayscale");
    const readableFontBtn = document.getElementById("readable-font");  
    const googleTranslateElement = document.getElementById('google_translate_element');
    
    // Ambil status dari localStorage jika ada
    let isSpeechEnabled = localStorage.getItem('isSpeechEnabled') === 'true';
    let isTranslateEnabled = false;
    let isGrayscaleEnabled = localStorage.getItem('isGrayscaleEnabled') === 'true';
    let isReadableFontEnabled = localStorage.getItem('isReadableFontEnabled') === 'true'; 


    updateButtonState();
    applyGrayscaleEffect();  
    applyReadableFontEffect(); 

    // Animasi Tombol Aksesibilitas
    btn.addEventListener('click', function() {
        let dropdownWidth = dropdown.offsetWidth;
        if (dropdown.style.transform === "translateX(-100%)") {
            dropdown.style.transform = "translateX(0%)";
            btn.style.transform = `translateX(${dropdownWidth}px)`; 
        } else {
            dropdown.style.transform = "translateX(-100%)";
            btn.style.transform = "translateX(0)"; 
        }
    });

    // Tombol Text to Speech
    speechBtn.addEventListener("click", function(event) {
        event.stopPropagation();
        isSpeechEnabled = !isSpeechEnabled;
        localStorage.setItem('isSpeechEnabled', isSpeechEnabled); 
        updateButtonState();
        if (isSpeechEnabled) {
            responsiveVoice.speak("Text to speech telah diaktifkan", "Indonesian Female");
        } else {
            responsiveVoice.cancel();
        }
    });

    // Tombol Terjemahan
    translateBtn.addEventListener("click", function(event) {
        event.stopPropagation(); 
        toggleTranslate();
    });

    // Tombol Grayscale
    grayscaleBtn.addEventListener("click", function(event) {
        event.stopPropagation(); 
        toggleGrayscale();
    });

    // Tombol Readable Font
    readableFontBtn.addEventListener("click", function(event) {
        event.stopPropagation(); 
        toggleReadableFont();
    });

    // Fungsi Mengganti Teks saat di toggle
    function updateButtonState() {
        
        // Text-to-speech
        if (isSpeechEnabled) {
            speechBtn.textContent = "Matikan Text-to-Speech";
            speechBtn.classList.add("active"); 
        } else {
            speechBtn.textContent = "Aktifkan Text-to-Speech";
            speechBtn.classList.remove("active"); 
        }

        // Terjemahan
        if (isTranslateEnabled) {
            translateBtn.textContent = "Kembali ke Bahasa Indonesia";
            translateBtn.classList.add("active");  
        } else {
            translateBtn.textContent = "Terjemahkan";
            translateBtn.classList.remove("active"); 
        }

        // Grayscale
        if (isGrayscaleEnabled) {
            grayscaleBtn.textContent = "Matikan Grayscale";
            grayscaleBtn.classList.add("active"); 
        } else {
            grayscaleBtn.textContent = "Grayscale";
            grayscaleBtn.classList.remove("active"); 
        }

        // Readable Font
        if (isReadableFontEnabled) {
            readableFontBtn.textContent = "Matikan Readable Font";
            readableFontBtn.classList.add("active"); 
        } else {
            readableFontBtn.textContent = "Readable Font";
            readableFontBtn.classList.remove("active"); 
        }
    }

    // Toggle Google Translate Sidebar
    function toggleTranslate() {
        if (!isTranslateEnabled) {
            googleTranslateElement.style.display = 'block';
            isTranslateEnabled = true;
            const script = document.createElement("script");
            script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
            document.body.appendChild(script);

            window.googleTranslateElementInit = function() {
                new google.translate.TranslateElement({
                    pageLanguage: 'id',  
                    includedLanguages: 'en,fr,ar,it,ja,de,zh-CN,zh-TW',
                    autoDisplay: false,  
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            };
        } else {
            
            isTranslateEnabled = false;
            googleTranslateElement.style.display = 'none';
            window.location.reload();  
        }

        updateButtonState();
    }

    // Toggle Grayscale
    function toggleGrayscale() {
        isGrayscaleEnabled = !isGrayscaleEnabled;
        localStorage.setItem('isGrayscaleEnabled', isGrayscaleEnabled);
        updateButtonState(); 
        applyGrayscaleEffect(); 
    }

    // Masukkan efek grayscale
    function applyGrayscaleEffect() {
        if (isGrayscaleEnabled) {
            document.body.style.filter = "grayscale(100%)"; 
        } else {
            document.body.style.filter = "none"; 
        }
    }

    // Toggle Readable Font
    function toggleReadableFont() {
        isReadableFontEnabled = !isReadableFontEnabled;
        localStorage.setItem('isReadableFontEnabled', isReadableFontEnabled); 
        updateButtonState();
        applyReadableFontEffect(); 
    }

    // masukkan font yang diubah
    function applyReadableFontEffect() {
        if (isReadableFontEnabled) {
            document.body.classList.add("readable-font");
        } else {
            document.body.classList.remove("readable-font");
        }
    }

    // Add hover listeners to speak text on hover
    const hoverElements = document.querySelectorAll("h1, h2, h3, h4, h5, a, p, li");
    hoverElements.forEach(element => {
        element.addEventListener("mouseover", function() {
            if (isSpeechEnabled) {
                speakText(this.innerText);
            }
        });
    });

    function speakText(text) {
        if (text) {
            responsiveVoice.speak(text, "Indonesian Female");
        }
    }
});

</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
