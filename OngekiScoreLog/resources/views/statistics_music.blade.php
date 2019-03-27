@extends('layouts.app')

@section('title', "[" . ucfirst($difficulty) . "] " . $musicData->title)
@section('hero_subtitle', "楽曲統計情報")
@section('hero_title', "[" . ucfirst($difficulty) . "] " . $musicData->title)
@section('additional_footer')
    {!!$highcharts->technical!!}
    {!!$highcharts->technical_sp!!}
<script type="text/javascript" src="{{ mix('/js/changeGraphSize.js') }}"></script>
@endsection
@if(isset($sidemark) && !is_null($sidemark))
    @section($sidemark, "is-active")
@endif

@section('content')
    <article class="box">
        <div class="buttons has-addons">
            @if ($isExist->normal)
                <a href="/music/{{$music}}/basic" class="button basic">Basic</a>
                <a href="/music/{{$music}}/advanced" class="button advanced">Advanced</a>
                <a href="/music/{{$music}}/expert" class="button expert">Expert</a>
                <a href="/music/{{$music}}/master" class="button master">Master</a>
            @endif
            @if ($isExist->lunatic)
                <a href="/user/music/{{$music}}/lunatic" class="button lunatic">Lunatic</a>
            @endif
        </div>
    </article>
    <article class="box">
        <h3 class="title is-3">テクニカルスコア</h3>
        <div id="graph"></div>
        <div id="sp-graph"></div>
        <button class="button change-graph-size">軸表示切り替え</button>
    </article>
    <article class="box">
        <div class="table_wrap scalable">
            <table class="table">
                <thead>
                    <tr>
                        <th>Rate</th>
                        <th>Technical Score</th>
                        <th>あなたのスコアとの差</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Rate</th>
                        <th>Technical Score</th>
                        <th>あなたのスコアとの差</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($statistics->technicalDifferenceScore as $key => $value)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$statistics->technicalAverageScore[$key]}}</td>
                        <td>{{$value}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>
@endsection