@extends('layout.app')

@section('contents')
    <h1>活动详情</h1>
    @include('layout._errors')
    <h2>{{$event->title}}</h2>
<p>	详情: {{$event->content}}</p>
<p>	开始时间: {{date('Y-m-d',$event->signup_start)}}</p>
<p>	结束时间: {{date('Y-m-d',$event->signup_end)}}</p>
<p>	开奖时间: {{$event->prize_date}}</p>
<p>	人数限制: {{$event->signup_num}}</p>
<p>
    是否开奖: {{$event->is_prize==0?'未开奖':'已开奖'}}
    @if($event->is_prize==0)
        <a href="{{route('events.kprize',[$event])}}" class="btn btn-warning">开奖</a>
        @endif
</p>
<div>



        @foreach($eventprizes as $eventprize)
            <p>奖品:  {{$eventprize->name}},描述: {{$eventprize->description}}</p>
            <p></p>
            @endforeach
            <a href="{{route('events.eventpc',[$event])}}">添加奖品</a>

</div>



@stop



