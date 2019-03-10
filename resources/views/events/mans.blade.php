@extends('layout.app')

@section('contents')
    <h1>活动以报名人数</h1>
    <table class="table table-bordered">
        <tr>
            <th>姓名</th>
            <th>活动</th>
            <th>状态</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->is_prize==0?'未开奖':'已开奖' }}</td>

            </tr>
        @endforeach
    </table>
@stop



