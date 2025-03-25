@for ($i=1;$i<=$data['order'];$i++)
@if ($data['edit']=='false')
    <option value="{{$i}}">{{$i}}</option>
@else
    <option {{$data['edit']==$i?'selected':null}} value="{{$i}}">{{$i}}</option>
@endif

@endfor