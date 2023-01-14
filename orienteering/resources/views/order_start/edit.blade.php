@extends('layouts/template')
@section('title')
    Lista Start - Editare
@endsection
@section('scripts-header')
    <link href="/css/plugins/datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
                    Configurare Lista Start Echipe
                </h1>

            </div>

            <form action="/order-start/edit" class="form-horizontal" method="post">
                {{ csrf_field() }}
            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ordine Start Categorii
                    </div>
                    <div class="panel-body">
                        <p><strong>Vă rugăm să alegeți ordinea generării startului pentru categorii:</strong></p>
                        <p>------------------</p>
                        @foreach($categories as $category)
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="email">Categorie {{ $category->category_name }}</label>
                            <div class="col-sm-4">
                                <select name="category_{{$category->category_id}}">
                                    <option <?php $number1 = 1 ?> @if($number1 == $category->order_start) selected="selected" @endif value="1">1</option>
                                    <option <?php $number2 = 2 ?> @if($number2 == $category->order_start) selected="selected" @endif value="2">2</option>
                                    <option <?php $number3 = 3 ?> @if($number3 == $category->order_start) selected="selected" @endif value="3">3</option>
                                    <option <?php $number4 = 4 ?> @if($number4 == $category->order_start) selected="selected" @endif value="4">4</option>
                                    <option <?php $number5 = 5 ?> @if($number5 == $category->order_start) selected="selected" @endif value="5">5</option>
                                    <option <?php $number6 = 6 ?> @if($number6 == $category->order_start) selected="selected" @endif value="6">6</option>
                                    <option <?php $number7 = 7 ?> @if($number7 == $category->order_start) selected="selected" @endif value="7">7</option>
                                </select>
                            </div>
                        </div>
                            <br /><br />
                        @endforeach


                        <p><strong>Ora de start 0:</strong></p>
                        <p>------------------</p>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">Ora Start</label>
                                <div class="col-sm-4">
                                    <input value="{{ $order_start->date_start }}" id="date_start" name="date_start" type="text" >
                                </div>
                            </div>
                            <br /><br />
                        <p><strong>Intervalul de minute intre echipe:</strong></p>
                        <p>------------------</p>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">Interval minute</label>
                                <div class="col-sm-4">
                                    <select name="minutes">
                                        <option @if($order_start->minutes == 1) selected="selected" @endif value="1">1</option>
                                        <option @if($order_start->minutes == 2) selected="selected" @endif value="2">2</option>
                                        <option @if($order_start->minutes == 3) selected="selected" @endif value="3">3</option>
                                        <option @if($order_start->minutes == 4) selected="selected" @endif value="4">4</option>
                                        <option @if($order_start->minutes == 5) selected="selected" @endif value="5">5</option>
                                        <option @if($order_start->minutes == 6) selected="selected" @endif value="6">6</option>
                                        <option @if($order_start->minutes == 7) selected="selected" @endif value="7">7</option>
                                        <option @if($order_start->minutes == 8) selected="selected" @endif value="8">8</option>
                                        <option @if($order_start->minutes == 9) selected="selected" @endif value="9">9</option>
                                        <option @if($order_start->minutes == 10) selected="selected" @endif value="10">10</option>
                                        <option @if($order_start->minutes == 11) selected="selected" @endif value="11">11</option>
                                        <option @if($order_start->minutes == 12) selected="selected" @endif value="12">12</option>
                                        <option @if($order_start->minutes == 13) selected="selected" @endif value="13">13</option>
                                        <option @if($order_start->minutes == 14) selected="selected" @endif value="1">14</option>
                                        <option @if($order_start->minutes == 15) selected="selected" @endif value="15">15</option>
                                        <option @if($order_start->minutes == 16) selected="selected" @endif value="16">16</option>
                                        <option @if($order_start->minutes == 17) selected="selected" @endif value="17">17</option>
                                        <option @if($order_start->minutes == 18) selected="selected" @endif value="18">18</option>
                                        <option @if($order_start->minutes == 19) selected="selected" @endif value="19">19</option>
                                        <option @if($order_start->minutes == 20) selected="selected" @endif value="20">20</option>
                                        <option @if($order_start->minutes == 21) selected="selected" @endif value="21">21</option>
                                        <option @if($order_start->minutes == 22) selected="selected" @endif value="22">22</option>
                                        <option @if($order_start->minutes == 23) selected="selected" @endif value="23">23</option>
                                        <option @if($order_start->minutes == 24) selected="selected" @endif value="24">24</option>
                                        <option @if($order_start->minutes == 25) selected="selected" @endif value="25">25</option>
                                        <option @if($order_start->minutes == 26) selected="selected" @endif value="26">26</option>
                                        <option @if($order_start->minutes == 27) selected="selected" @endif value="27">27</option>
                                        <option @if($order_start->minutes == 28) selected="selected" @endif value="28">28</option>
                                        <option @if($order_start->minutes == 29) selected="selected" @endif value="29">29</option>
                                        <option @if($order_start->minutes == 30) selected="selected" @endif value="30">30</option>
                                        <option @if($order_start->minutes == 31) selected="selected" @endif value="31">31</option>
                                        <option @if($order_start->minutes == 32) selected="selected" @endif value="32">32</option>
                                        <option @if($order_start->minutes == 33) selected="selected" @endif value="33">33</option>
                                        <option @if($order_start->minutes == 34) selected="selected" @endif value="34">34</option>
                                        <option @if($order_start->minutes == 35) selected="selected" @endif value="35">35</option>
                                        <option @if($order_start->minutes == 36) selected="selected" @endif value="36">36</option>
                                        <option @if($order_start->minutes == 37) selected="selected" @endif value="37">37</option>
                                        <option @if($order_start->minutes == 38) selected="selected" @endif value="38">38</option>
                                        <option @if($order_start->minutes == 39) selected="selected" @endif value="39">39</option>
                                        <option @if($order_start->minutes == 40) selected="selected" @endif value="40">40</option>
                                        <option @if($order_start->minutes == 41) selected="selected" @endif value="41">41</option>
                                        <option @if($order_start->minutes == 42) selected="selected" @endif value="42">42</option>
                                        <option @if($order_start->minutes == 43) selected="selected" @endif value="43">43</option>
                                        <option @if($order_start->minutes == 44) selected="selected" @endif value="44">44</option>
                                        <option @if($order_start->minutes == 45) selected="selected" @endif value="45">45</option>
                                        <option @if($order_start->minutes == 46) selected="selected" @endif value="46">46</option>
                                        <option @if($order_start->minutes == 47) selected="selected" @endif value="47">47</option>
                                        <option @if($order_start->minutes == 48) selected="selected" @endif value="48">48</option>
                                        <option @if($order_start->minutes == 49) selected="selected" @endif value="49">49</option>
                                        <option @if($order_start->minutes == 50) selected="selected" @endif value="50">50</option>
                                        <option @if($order_start->minutes == 51) selected="selected" @endif value="51">51</option>
                                        <option @if($order_start->minutes == 52) selected="selected" @endif value="52">52</option>
                                        <option @if($order_start->minutes == 53) selected="selected" @endif value="53">53</option>
                                        <option @if($order_start->minutes == 54) selected="selected" @endif value="54">54</option>
                                        <option @if($order_start->minutes == 55) selected="selected" @endif value="55">55</option>
                                        <option @if($order_start->minutes == 56) selected="selected" @endif value="56">56</option>
                                        <option @if($order_start->minutes == 57) selected="selected" @endif value="57">57</option>
                                        <option @if($order_start->minutes == 58) selected="selected" @endif value="58">58</option>
                                        <option @if($order_start->minutes == 59) selected="selected" @endif value="59">59</option>
                                        <option @if($order_start->minutes == 60) selected="selected" @endif value="60">60</option>
                                        </select>
                                    minute
                                </div>
                            </div>
                        <br />
                        <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        <br />
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts-footer')
    <script src="/js/plugins/datetimepicker/jquery.datetimepicker.full.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            var d = new Date();
            var timeArr = [];
            for (var i = 0; i < 24; i++) {
                timeArr.push(i + ":00");
                timeArr.push(i + ":05");
                timeArr.push(i + ":10");
                timeArr.push(i + ":15");
                timeArr.push(i + ":20");
                timeArr.push(i + ":25");
                timeArr.push(i + ":30");
                timeArr.push(i + ":35");
                timeArr.push(i + ":40");
                timeArr.push(i + ":45");
                timeArr.push(i + ":50");
                timeArr.push(i + ":55");
            }
            jQuery('#date_start').datetimepicker({
                format: 'Y-m-d H:i:00',
                allowTimes: timeArr,
                minDate: new Date()
            });
        });

        </script>
@endsection