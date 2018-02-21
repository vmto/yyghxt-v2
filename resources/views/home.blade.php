@extends('layouts.base')

@section('content')
    <link href="https://cdn.bootcss.com/photoswipe/4.1.2/photoswipe.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/photoswipe/4.1.2/default-skin/default-skin.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/photoswipe/4.1.2/photoswipe.min.js"></script>
    <script src="https://cdn.bootcss.com/photoswipe/4.1.2/photoswipe-ui-default.min.js"></script>
    <div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-header">
                <form class="form-inline" action="{{route('home.search')}}"  id="search-form" name="search-form" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="searchDate">日期：</label>
                        <input type="text" class="form-control date-item" name="searchDateStart" id="searchDateStart" required value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$start)->toDateString()}}">
                        到
                        <input type="text" class="form-control date-item" name="searchDateEnd" id="searchDateEnd" required value="{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$end)->toDateString()}}">
                    </div>
                    <button type="submit" class="btn btn-success">搜索</button>
                </form>
            </div>
            <div class="box-body" id="table-sum-box-body">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;" id="today-pro" class="img-dom" data-toggle="modal" data-target="#proModal" data-id="tab-sum">
                    项目情况表
                </h4>
                <div class="box">
                    <div class="box-body table-responsive table-bordered">
                        <style type="text/css">
                            table.tab-sum tr,table.tab-sum th,table.tab-sum td{border: solid 1px #666;}
                        </style>
                        <table class="table table-hover text-center tab-sum table-dom" id="tab-sum">
                            <thead>
                            <tr style="background: #66d7ea;">
                                <th>项目</th>
                                <th>咨询量</th>
                                <th>预约量</th>
                                <th>留联系</th>
                                <th>电话量</th>
                                <th>总咨询量</th>
                                <th>应到院</th>
                                <th>到院量</th>
                                <th>就诊量</th>
                                <th>预约率</th>
                                <th>留联率</th>
                                <th>到院率</th>
                                <th>就诊率</th>
                                <th>咨询转化率</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['zixun_count']}}</td>
                                    <td>{{$v['yuyue_count']}}</td>
                                    <td>{{$v['contact_count']}}</td>
                                    <td>{{$v['tel_count']}}</td>
                                    <td>{{$v['total_count']}}</td>
                                    <td>{{$v['should_count']}}</td>
                                    <td>{{$v['arrive_count']}}</td>
                                    <td>{{$v['jiuzhen_count']}}</td>
                                    <td>{{$v['yuyue_rate']}}</td>
                                    <td>{{$v['contact_rate']}}</td>
                                    <td>{{$v['arrive_rate']}}</td>
                                    <td>{{$v['jiuzhen_rate']}}</td>
                                    <td>{{$v['zhuanhua_rate']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <p class="visible-xs text-red">提示：手机点击标题查看<p/>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-body" id="table-range-box-body">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;" id="todayRange" class="table-head" data-id="table-range">
                    今日排班
                </h4>
                <div class="box">
                    <div class="box-body table-responsive table-bordered">
                        <style type="text/css">
                            /*table.table-arrangement td{border-color: #ccc !important;}*/
                            table.table-arrangement tr,table.table-arrangement th,table.table-arrangement td{border: solid 1px #666;}
                        </style>
                        <table class="table table-hover text-center table-arrangement" id="table-range">
                            <thead>
                            <tr style="background: #66d7ea;">
                                <th>项目</th>
                                <th>班次</th>
                                <th>咨询</th>
                                <th>竞价</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($arrangements))
                                @foreach($arrangements as $officesort)
                                    @foreach($officesort['ranks'] as $ranksort)
                                        <tr>
                                            @if($loop->first)
                                                <td rowspan="{{$loop->count}}" style="vertical-align: middle;">{{$officesort['office']}}</td>
                                            @endif
                                            <td>{{$ranksort['rank']}}</td>
                                            <td>
                                                @if(!empty($ranksort['departments']))
                                                    @foreach($ranksort['departments'] as $v)
                                                        @if($v['department']=='zixun')
                                                            @if(!empty($v['users']))
                                                                @foreach($v['users'] as $user)
                                                                    {{$user}}
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($ranksort['departments']))
                                                    @foreach($ranksort['departments'] as $v)
                                                        @if($v['department']=='jingjia')
                                                            @if(!empty($v['users']))
                                                                @foreach($v['users'] as $user)
                                                                    {{$user}}
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-body" id="month-data-box-body">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;" id="month-data-head" class="table-head" data-id="month-data">
                    上月数据({{\Carbon\Carbon::now()->subMonth()->year}}-{{\Carbon\Carbon::now()->subMonth()->month}})
                </h4>
                <div class="box">
                    <div class="box-body table-responsive table-bordered">
                        <style type="text/css">
                            table.tab-sum tr,table.tab-sum th,table.tab-sum td{border: solid 1px #666;}
                        </style>
                        <table class="table table-hover text-center tab-sum" id="month-data">
                            <thead>
                            <tr style="background: #66d7ea;">
                                <th>项目</th>
                                <th>咨询量</th>
                                <th>预约量</th>
                                <th>留联系</th>
                                <th>电话量</th>
                                <th>总咨询量</th>
                                <th>应到院</th>
                                <th>到院量</th>
                                <th>就诊量</th>
                                <th>预约率</th>
                                <th>留联率</th>
                                <th>到院率</th>
                                <th>就诊率</th>
                                <th>咨询转化率</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($monthData as $v)
                                <tr>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['zixun_count']}}</td>
                                    <td>{{$v['yuyue_count']}}</td>
                                    <td>{{$v['contact_count']}}</td>
                                    <td>{{$v['tel_count']}}</td>
                                    <td>{{$v['total_count']}}</td>
                                    <td>{{$v['should_count']}}</td>
                                    <td>{{$v['arrive_count']}}</td>
                                    <td>{{$v['jiuzhen_count']}}</td>
                                    <td>{{$v['yuyue_rate']}}</td>
                                    <td>{{$v['contact_rate']}}</td>
                                    <td>{{$v['arrive_rate']}}</td>
                                    <td>{{$v['jiuzhen_rate']}}</td>
                                    <td>{{$v['zhuanhua_rate']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-body" id="year-data-box-body">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;" class="table-head" data-id="year-data">
                    {{\Carbon\Carbon::now()->year}}年汇总数据
                </h4>
                <div class="box">
                    <div class="box-body table-responsive table-bordered">
                        <style type="text/css">
                            table.tab-sum tr,table.tab-sum th,table.tab-sum td{border: solid 1px #666;}
                        </style>
                        <table class="table table-hover text-center tab-sum" id="year-data">
                            <thead>
                            <tr style="background: #66d7ea;">
                                <th>项目</th>
                                <th>咨询量</th>
                                <th>预约量</th>
                                <th>留联系</th>
                                <th>电话量</th>
                                <th>总咨询量</th>
                                <th>应到院</th>
                                <th>到院量</th>
                                <th>就诊量</th>
                                <th>预约率</th>
                                <th>留联率</th>
                                <th>到院率</th>
                                <th>就诊率</th>
                                <th>咨询转化率</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($yearData as $v)
                                <tr>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['zixun_count']}}</td>
                                    <td>{{$v['yuyue_count']}}</td>
                                    <td>{{$v['contact_count']}}</td>
                                    <td>{{$v['tel_count']}}</td>
                                    <td>{{$v['total_count']}}</td>
                                    <td>{{$v['should_count']}}</td>
                                    <td>{{$v['arrive_count']}}</td>
                                    <td>{{$v['jiuzhen_count']}}</td>
                                    <td>{{$v['yuyue_rate']}}</td>
                                    <td>{{$v['contact_rate']}}</td>
                                    <td>{{$v['arrive_rate']}}</td>
                                    <td>{{$v['jiuzhen_rate']}}</td>
                                    <td>{{$v['zhuanhua_rate']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <style>
        #proModal .column-title{background: #66d7ea;}
        #proModal .pro-columns>div{line-height: 3rem;height: 3rem;font-size: 1.5rem;}
        #proModal .pro-columns:nth-child(odd){border-right: solid 1px #ccc;}
    </style>
    <div class="modal fade" id="proModal" tabindex="-1" role="dialog" aria-labelledby="proModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="proModalLabel">预览</h4>
                </div>
                <div class="modal-body box">
                    @foreach($data as $v)
                        <h3 class="text-center">{{$v['name']}}</h3>
                        <style>
                            #mobile-table tr,#mobile-table th,#mobile-table td{border: solid 1px #666;}
                            #mobile-table .table-mobile-column{background: #66d7ea;}
                        </style>
                        <table class="table table-hover text-center table-mobile" id="mobile-table">
                            <tr class="table-mobile-column">
                                <th>咨询量</th>
                                <th>预约量</th>
                            </tr>
                            <tr>
                                <td>{{$v['zixun_count']}}</td>
                                <td>{{$v['yuyue_count']}}</td>
                            </tr>
                            <tr class="table-mobile-column">
                                <th>留联系</th>
                                <th>电话量</th>
                            </tr>
                            <tr>
                                <td>{{$v['contact_count']}}</td>
                                <td>{{$v['tel_count']}}</td>
                            </tr>
                            <tr class="table-mobile-column">

                                <th>总咨询量</th>
                                <th>应到院</th>
                            </tr>
                            <tr>
                                <td>{{$v['total_count']}}</td>
                                <td>{{$v['should_count']}}</td>
                            </tr>
                            <tr class="table-mobile-column">
                                <th>到院量</th>
                                <th>就诊量</th>
                            </tr>
                            <tr>
                                <td>{{$v['arrive_count']}}</td>
                                <td>{{$v['jiuzhen_count']}}</td>
                            </tr>
                            <tr class="table-mobile-column">
                                <th>预约率</th>
                                <th>留联率</th>
                            </tr>
                            <tr>
                                <td>{{$v['yuyue_rate']}}</td>
                                <td>{{$v['contact_rate']}}</td>
                            </tr>
                            <tr class="table-mobile-column">
                                <th>到院率</th>
                                <th>就诊率</th>
                            </tr>
                            <tr>
                                <td>{{$v['arrive_rate']}}</td>
                                <td>{{$v['jiuzhen_rate']}}</td>
                            </tr>
                            <tr class="table-mobile-column">
                                <th>咨询转化率</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>{{$v['zhuanhua_rate']}}</td>
                                <td></td>
                            </tr>
                        </table>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <button id="btn">Open PhotoSwipe</button>

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
             It's a separate element, as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
            <div class="pswp__container">
                <!-- don't modify these 3 pswp__item elements, data is added later on -->
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('javascript')
    <script src="https://cdn.bootcss.com/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script type="text/javascript" src="/asset/laydate/laydate.js"></script>
    <script type="text/javascript">
        lay('.date-item').each(function(){
            laydate.render({
                elem: this
                ,trigger: 'click'
            });
        });

        $(document).ready(function () {

            $('.table-head').on('click',function () {
                var nodeId=$(this).attr('data-id');
                var node = document.getElementById(nodeId);
                domtoimage.toSvg(node,{bgcolor: '#fff'})
                    .then(function (dataUrl) {
                        var openPhotoSwipe = function() {
                            var pswpElement = document.querySelectorAll('.pswp')[0];
                            // build items array
                            var items = [
                                {
                                    src: dataUrl,
                                    w: 1100,
                                    h: 150,
                                    zoomEl: true,
                                    shareEl: true,
                                }
                            ];
                            // define options (if needed)
                            var options = {
                                // history & focus options are disabled on CodePen
                                history: false,
                                focus: false,
                                showAnimationDuration: 0,
                                hideAnimationDuration: 0
                            };
                            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                            gallery.init();
                        };
                        openPhotoSwipe();
                        // document.getElementById('btn').onclick = openPhotoSwipe;
                        // var img = new Image();
                        // img.src = dataUrl;
                        // document.body.appendChild(img);
                    });
                // domtoimage.toSvg(node).then(function (dataUrl) {
                //         $.ajax({
                //             url:'/home/uploadimage',
                //             type:'post',
                //             data:{'imgData':dataUrl,'_token': $('input[name=_token]').val()},
                //             success:function (data) {
                //                 // console.log(data);
                //                 // alert(data);
                //                 window.location.href=data;
                //             }
                //         });
                //     });
            });
        });

    </script>
@endsection
