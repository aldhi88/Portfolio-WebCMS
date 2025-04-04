$(function () {
    var m,
        g = -1,
        b = 0;
    $("#closeButton").click(function () {
        $(this).is(":checked") ? $("#addBehaviorOnToastCloseClick").prop("disabled", !1) : ($("#addBehaviorOnToastCloseClick").prop("disabled", !0), $("#addBehaviorOnToastCloseClick").prop("checked", !1));
    }),
        $("#showtoast").click(function () {
            var t,
                o,
                e = $("#toastTypeGroup input:radio:checked").val(),
                a = $("#message").val(),
                n = $("#title").val() || "",
                s = $("#showDuration"),
                i = $("#hideDuration"),
                r = $("#timeOut"),
                l = $("#extendedTimeOut"),
                c = $("#showEasing"),
                p = $("#hideEasing"),
                d = $("#showMethod"),
                h = $("#hideMethod"),
                u = b++,
                k = $("#addClear").prop("checked");
            (toastr.options = {
                closeButton: $("#closeButton").prop("checked"),
                debug: $("#debugInfo").prop("checked"),
                newestOnTop: $("#newestOnTop").prop("checked"),
                progressBar: $("#progressBar").prop("checked"),
                rtl: $("#rtl").prop("checked"),
                positionClass: $("#positionGroup input:radio:checked").val() || "toast-top-right",
                preventDuplicates: $("#preventDuplicates").prop("checked"),
                onclick: null,
            }),
                $("#addBehaviorOnToastClick").prop("checked") &&
                    (toastr.options.onclick = function () {
                        alert("You can perform some custom action after a toast goes away");
                    }),
                $("#addBehaviorOnToastCloseClick").prop("checked") &&
                    (toastr.options.onCloseClick = function () {
                        alert("You can perform some custom action when the close button is clicked");
                    }),
                s.val().length && (toastr.options.showDuration = parseInt(s.val())),
                i.val().length && (toastr.options.hideDuration = parseInt(i.val())),
                r.val().length && (toastr.options.timeOut = k ? 0 : parseInt(r.val())),
                l.val().length && (toastr.options.extendedTimeOut = k ? 0 : parseInt(l.val())),
                c.val().length && (toastr.options.showEasing = c.val()),
                p.val().length && (toastr.options.hideEasing = p.val()),
                d.val().length && (toastr.options.showMethod = d.val()),
                h.val().length && (toastr.options.hideMethod = h.val()),
                k && ((t = (t = a) || "Clear itself?"), (a = t += '<br /><br /><button type="button" class="btn-primary btn clear">Yes</button>'), (toastr.options.tapToDismiss = !1)),
                a ||
                    (++g ===
                        (o = [
                            "My name is Inigo Montoya. You killed my father. Prepare to die!",
                            '<div><input class="input-small form-control form-control-sm mb-2" placeholder="textbox"/>&nbsp;<a href="" target="_blank">This is a hyperlink</a></div><div><button type="button" id="okBtn" class="btn btn-primary mt-2">Close me</button><button type="button" id="surpriseBtn" class="btn text-white  mt-2" style="margin: 0 8px 0 8px">Surprise me</button></div>',
                            "Are you the six fingered man?",
                            "Inconceivable!",
                            "I do not think that means what you think it means.",
                            "Have fun storming the castle!",
                        ]).length && (g = 0),
                    (a = o[g])),
                $("#toastrOptions").text('Command: toastr["' + e + '"]("' + a + (n ? '", "' + n : "") + '")\n\ntoastr.options = ' + JSON.stringify(toastr.options, null, 2));
            var v = toastr[e](a, n);
            void 0 !== (m = v) &&
                (v.find("#okBtn").length &&
                    v.delegate("#okBtn", "click", function () {
                        alert("you clicked me. i was toast #" + u + ". goodbye!"), v.remove();
                    }),
                v.find("#surpriseBtn").length &&
                    v.delegate("#surpriseBtn", "click", function () {
                        alert("Surprise! you clicked me. i was toast #" + u + ". You could perform an action here.");
                    }),
                v.find(".clear").length &&
                    v.delegate(".clear", "click", function () {
                        toastr.clear(v, { force: !0 });
                    }));
        }),
        $("#clearlasttoast").click(function () {
            toastr.clear(m);
        }),
        $("#cleartoasts").click(function () {
            toastr.clear();
        });
});
