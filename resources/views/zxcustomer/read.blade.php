@extends('layouts.base')

@section('content')
    @include('layouts.tip')
    <link type="text/css" href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <style>
        .content{padding-top: 0;}
        #search-form hr{margin-top: 1px;margin-bottom: 1px;}
        #search-form .form-group input{width: 150px;}
        #search-form .form-group{position: relative;}
        #search-form .form-tips{position: absolute;z-index: 800;top:33px;left: 80px;padding: 5px;background: #d2d6de;display: none;}
    </style>
    <div class="box collapsed-box" style="margin-bottom: 0;">
        <div class="box-header">
            <h3 class="box-title">高级搜索</h3>
            <div class="box-tools pull-left" style="left: 110px;">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-plus text-success"></i>
                </button>
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">--}}
                    {{--<i class="fa fa-times"></i></button>--}}
            </div>
        </div>
        <div class="box-body">
            <form class="form-inline" action="{{route('zxcustomers.search')}}"  id="search-form" name="search-form" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="quickSearch" value="">
                <input type="hidden" name="parameters" value="{{isset($parameters)?json_encode($parameters):''}}">
                <div class="form-group">
                    <label for="searchCustomerName">姓名：</label>
                    <input type="text" class="form-control" name="searchCustomerName" id="searchCustomerName" placeholder="姓名" value="{{isset($parameters['name'])?$parameters['name']:''}}">
                </div>
                <div class="form-group">
                    <label for="searchCustomerTel">电话：</label>
                    <input type="text" class="form-control" name="searchCustomerTel" id="searchCustomerTel" placeholder="电话" value="{{isset($parameters['tel'])?$parameters['tel']:''}}">
                </div>
                <div class="form-group">
                    <label for="searchCustomerQQ">QQ：</label>
                    <input type="text" class="form-control" name="searchCustomerQQ" id="searchCustomerQQ" placeholder="QQ" value="{{isset($parameters['qq'])?$parameters['qq']:''}}">
                </div>
                <div class="form-group">
                    <label for="searchCustomerWechat">微信：</label>
                    <input type="text" class="form-control" name="searchCustomerWechat" id="searchCustomerWechat" placeholder="微信" value="{{isset($parameters['wechat'])?$parameters['wechat']:''}}">
                </div>
                <div class="form-group">
                    <label for="searchIdCard">商务通ID：</label>
                    <input type="text" class="form-control" name="searchIdCard" id="searchIdCard" placeholder="商务通ID" value="{{isset($parameters['swt'])?$parameters['swt']:''}}">
                </div>
                <hr/>
                <div class="form-group">
                    <label for="searchZx">咨询时间：</label>
                    <input type="text" class="form-control date-item" name="searchZxStart" id="searchZxStart" value="{{isset($parameters['zixun_at_start'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['zixun_at_start'])->toDateString():''}}">
                    到
                    <input type="text" class="form-control date-item" name="searchZxEnd" id="searchZxEnd" value="{{isset($parameters['zixun_at_end'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['zixun_at_end'])->toDateString():''}}">
                    <div class="form-tips">
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">今天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::yesterday()->toDateString()}}" data-end="{{\Carbon\Carbon::yesterday()->toDateString()}}">昨天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(3)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近三天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(7)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近七天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(30)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近一个月</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->startOfMonth()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">本月</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="searchYuyue">预约时间：</label>
                    <input type="text" class="form-control date-item" name="searchYuyueStart" id="searchYuyueStart" value="{{isset($parameters['yuyue_at_start'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['yuyue_at_start'])->toDateString():''}}">
                    到
                    <input type="text" class="form-control date-item" name="searchYuyueEnd" id="searchYuyueEnd" value="{{isset($parameters['yuyue_at_end'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['yuyue_at_end'])->toDateString():''}}">
                    <div class="form-tips">
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">今天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::yesterday()->toDateString()}}" data-end="{{\Carbon\Carbon::yesterday()->toDateString()}}">昨天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::tomorrow()->toDateString()}}" data-end="{{\Carbon\Carbon::tomorrow()->toDateString()}}">明天</span>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <label for="searchArrive">到院时间：</label>
                    <input type="text" class="form-control date-item" name="searchArriveStart" id="searchArriveStart" value="{{isset($parameters['arrive_start'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['arrive_start'])->toDateString():''}}">
                    到
                    <input type="text" class="form-control date-item" name="searchArriveEnd" id="searchArriveEnd" value="{{isset($parameters['arrive_end'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['arrive_end'])->toDateString():''}}">
                    <div class="form-tips">
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">今天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::yesterday()->toDateString()}}" data-end="{{\Carbon\Carbon::yesterday()->toDateString()}}">昨天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::tomorrow()->toDateString()}}" data-end="{{\Carbon\Carbon::tomorrow()->toDateString()}}">明天</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="searchLastHuifang">最近回访时间：</label>
                    <input type="text" class="form-control date-item" name="searchLastHuifangStart" id="searchLastHuifangStart" value="{{isset($parameters['last_start'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['last_start'])->toDateString():''}}">
                    到
                    <input type="text" class="form-control date-item" name="searchLastHuifangEnd" id="searchLastHuifangEnd" value="{{isset($parameters['last_end'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['last_end'])->toDateString():''}}">
                    <div class="form-tips">
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">今天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::yesterday()->toDateString()}}" data-end="{{\Carbon\Carbon::yesterday()->toDateString()}}">昨天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(3)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近三天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(7)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近七天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->subDays(30)->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">最近一个月</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->startOfMonth()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">本月</span>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <label for="searchNextHuifang">下次回访时间：</label>
                    <input type="text" class="form-control date-item" name="searchNextHuifangStart" id="searchNextHuifangStart" value="{{isset($parameters['next_at_start'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['next_at_start'])->toDateString():''}}">
                    到
                    <input type="text" class="form-control date-item" name="searchNextHuifangEnd" id="searchNextHuifangEnd" value="{{isset($parameters['next_at_end'])?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$parameters['next_at_end'])->toDateString():''}}">
                    <div class="form-tips">
                        <span class="qdate" data-start="{{\Carbon\Carbon::now()->toDateString()}}" data-end="{{\Carbon\Carbon::now()->toDateString()}}">今天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::yesterday()->toDateString()}}" data-end="{{\Carbon\Carbon::yesterday()->toDateString()}}">昨天</span>
                        <span class="qdate" data-start="{{\Carbon\Carbon::tomorrow()->toDateString()}}" data-end="{{\Carbon\Carbon::tomorrow()->toDateString()}}">明天</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="searchUserId">最近回访人：</label>
                    <select name="searchLastHuifangUserId" id="searchLastHuifangUserId" class="form-control">
                        <option value="">--回访人--</option>
                        @foreach($zxusers as $k=>$user)
                            <option value="{{$k}}" {{isset($parameters['last_user_id'])&&$parameters['last_user_id']==$k?'selected':''}}>{{$user}}</option>
                        @endforeach
                    </select>
                </div>
                <hr />
                <div class="form-group">
                    <label for="searchOfficeId">科室：</label>
                    <select name="searchOfficeId" id="searchOfficeId" class="form-control">
                        <option value="">--科室--</option>
                        @foreach(Auth::user()->offices as $office)
                            <option value="{{$office->id}}" {{isset($parameters['office_id'])&&$parameters['office_id']==$office->id?'selected':''}}>{{$office->display_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="searchDiseaseId">病种：</label>
                    <select name="searchDiseaseId" id="searchDiseaseId" class="form-control">
                        <option value="">--病种--</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="searchUserId">咨询员：</label>
                    <select name="searchUserId" id="searchUserId" class="form-control">
                        <option value="">--咨询员--</option>
                        @foreach($zxusers as $k=>$user)
                            <option value="{{$k}}" {{isset($parameters['zx_user_id'])&&$parameters['zx_user_id']==$k?'selected':''}}>{{$user}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="searchUserId">媒体来源：</label>
                    <select name="searchMediaId" id="searchMediaId" class="form-control">
                        <option value="">--媒体来源--</option>
                        @foreach($medias as $k=>$media)
                            <option value="{{$k}}" {{isset($parameters['media_id'])&&$parameters['media_id']==$k?'selected':''}}>{{$media}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="searchCustomerCondition">患者状态：</label>
                    <select name="searchCustomerCondition" id="searchCustomerCondition" class="form-control">
                        <option value="">--患者状态--</option>
                        @foreach($customerconditions as $k=>$customercondition)
                            <option value="{{$k}}" {{isset($parameters['customer_condition_id'])&&$parameters['customer_condition_id']==$k?'selected':''}}>{{$customercondition}}</option>
                        @endforeach
                    </select>
                </div>
                <hr />
                <button type="submit" class="btn btn-success">搜索</button>
                <button type="reset" class="btn btn-warning form-reset">重置</button>
                <button type="button" class="btn btn-danger form-empty">清空</button>
            </form>
        </div>
        <!-- /.box-body -->
        {{--<div class="box-footer">--}}
        {{--</div>--}}
        <!-- /.box-footer-->
    </div>
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">列表</h3>
            <a href="javascript:;" class="btn-sm btn-info" id="strlimit">展开</a>
            <div class="box-tools">
                <div class="input-group input-group-sm pull-right" style="">
                    @ability('superadministrator', 'create-zx_customers')
                    <a href="{{route('zxcustomers.create')}}" class="btn-sm btn-success">新增</a>
                    @endability
                </div>
                <div class="input-group input-group-sm pull-right" style="margin-right: 1rem;">
                    <a href="javascript:;" class="btn-sm btn-info" id="todayarrive">今日应到院(<span class="text-red">{{isset($todayArrive)?$todayArrive:0}}</span>)</a>
                </div>
                <div class="input-group input-group-sm pull-right" style="margin-right: 1rem;">
                    <a href="javascript:;" class="btn-sm btn-info" id="todayhuifang">今日应回访(<span class="text-red">{{isset($todayHuifang)?$todayHuifang:0}}</span>)</a>
                </div>
                <div class="input-group input-group-sm pull-right" style="margin-right: 1rem;">
                    <a href="javascript:;" class="btn-sm btn-info" id="todayarrived">今日到院(<span class="text-red">{{isset($todayarrived)?$todayarrived:0}}</span>)</a>
                </div>
                <div class="input-group input-group-sm pull-right" style="margin-right: 1rem;">
                    <a href="javascript:;" class="btn-sm btn-info" id="todayyuyue">今日预约(<span class="text-red">{{isset($todayyuyue)?$todayyuyue:0}}</span>)</a>
                </div>
            </div>
        </div>
        <form action="" method="post" class="zxcustomers-form">
        <div class="box-body table-responsive">
                {{method_field('DELETE')}}
                {{csrf_field()}}
            <style>
                #zxcustomers-list-table th{padding-right: 0;}
                #zxcustomers-list-table th:after{content: '';}
            </style>
                <table id="zxcustomers-list-table" class="table table-striped table-bordered text-center" style="font-size: 14px;">
                    <thead>
                    <tr>
                        <th style="display: none;"><i class="fa fa-level-down" aria-hidden="true"></i></th>
                        <th>患者</th>
                        <th>年龄</th>
                        <th>性别</th>
                        <th>联系</th>
                        <th>微信</th>
                        <th>QQ</th>
                        <th style="display: none;">id</th>
                        <th>关键词</th>
                        <th>城市</th>
                        <th>来源</th>
                        <th>网站</th>
                        <th>科室</th>
                        <th>病种</th>
                        <th>状态</th>
                        <th>初复诊</th>
                        <th>未约原因</th>
                        <th>咨询员</th>
                        <th>当班竞价</th>
                        <th>咨询</th>
                        <th>预约</th>
                        <th>时段</th>
                        <th>到院</th>
                        <th>最近回访</th>
                        <th>最近回访人</th>
                        <th>下次回访</th>
                        <th>下次回访人</th>
                        <th style="display: none;">类型</th>
                        <th style="display: none;">备注</th>
                        <th>回访</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($customers))
                    @foreach($customers as $customer)
                        <tr id="customer-{{$customer->id}}" class="{{isset($quicksearch)&&$quicksearch=='todayhuifang'&&$customer->huifangs->last()&&($customer->huifangs->last()->next_at>=\Carbon\Carbon::now()->endOfDay()||$customer->huifangs->last()->now_at>=\Carbon\Carbon::now()->startOfDay())?'bg-red':''}}" style="{{($customer->customer_condition_id==1||$customer->customer_condition==2)?'color:red;':''}}">
                            <td style="display: none;">{{$customer->id}}</td>
                            <td>
                                <span data-toggle="tooltip" data-placement="right" title="{{$customer->name?$customer->name:''}}" data-title="{{$customer->name?$customer->name:''}}" data-limit="{{str_limit($customer->name?$customer->name:'', $limit = 6, $end = '...')}}" class="strlimit">{{str_limit($customer->name?$customer->name:'', $limit = 6, $end = '...')}}</span>
                            </td>
                            <td>{{$customer->age}}</td>
                            <td>
                                @if(!empty($customer->sex))
                                    @if($customer->sex=='male')
                                        男
                                    @elseif($customer->sex=='female')
                                        女
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-toggle="modal" data-customer="{{$customer->id}}" data-name="{{$customer->name}}"
                                   data-tel="{{\App\Aiden::phoneCheck($customer->tel,$customer->customer_condition_id,$enableViewPhone,$isAdmin,3,$customer->user_id,$customer->arrive_at)}}"
                                   data-office="{{$customer->office_id}}" class="text-black sendMsg">
                                    <small class="{{$customer->msg?'text-blue':'text-black'}}">{{\App\Aiden::phoneCheck($customer->tel,$customer->customer_condition_id,$enableViewPhone,$isAdmin,3,$customer->user_id,$customer->arrive_at)}}</small>
                                </a>
                            </td>
                            <td>
                                <small>
                                    {{\App\Aiden::phoneCheck($customer->wechat,$customer->customer_condition_id,$enableViewWechat,$isAdmin,3,$customer->user_id,$customer->arrive_at)}}
                                </small>
                            </td>
                            <td>
                                <small>
                                    {{$customer->qq?$customer->qq:''}}
                                </small>
                            </td>
                            <td style="display: none;"><small>{{$customer->idcard}}</small></td>
                            <td>
                                <span data-toggle="modal" data-placement="top" data-target="#keywordsContent" title="{{$customer->keywords?$customer->keywords:''}}" title="{{$customer->keywords?$customer->keywords:''}}" data-title="{{$customer->keywords?$customer->keywords:''}}" data-limit="{{str_limit($customer->keywords?$customer->keywords:'', $limit = 12, $end = '...')}}" class="keywordsContent strlimit">{{str_limit($customer->keywords?$customer->keywords:'', $limit = 12, $end = '...')}}</span>
                                {{--<span >{{$customer->keywords?$customer->keywords:''}}</span>--}}
                            </td>
                            <td>
                                <small>
                                    <span data-toggle="tooltip" data-placement="top" title="{{$customer->city?$customer->city:''}}" data-title="{{$customer->city?$customer->city:''}}" data-limit="{{str_limit($customer->city?$customer->city:'', $limit = 4, $end = '...')}}" class="strlimit">{{str_limit($customer->city?$customer->city:'', $limit = 4, $end = '...')}}</span>
                                </small>
                            </td>
                            {{--媒体来源--}}
                            <td><small>{{$customer->media_id?$medias[$customer->media_id]:''}}</small></td>
                            {{--网站类型--}}
                            <td><small>{{$customer->webtype_id?$webtypes[$customer->webtype_id]:''}}</small></td>
                            {{--科室--}}
                            <td><small>{{$customer->office_id?$offices[$customer->office_id]:''}}</small></td>
                            {{--病种--}}
                            <td><small>{{$customer->disease_id?$diseases[$customer->disease_id]:''}}</small></td>
                            {{--状态--}}
                            <td><small>{{$customer->customer_condition_id?$customerconditions[$customer->customer_condition_id]:''}}</small></td>
                            <td><small>{{$customer->fuzhen==1?'复诊':'初诊'}}</small></td>
                            {{--未预约原因--}}
                            <td>
                                <small>
                                    {{$customer->cause_id?$causes[$customer->cause_id]:''}}
                                </small>
                            </td>
                            {{--咨询员--}}
                            <td><small>{{$customer->user_id?$users[$customer->user_id]:''}}</small></td>
                            {{--竞价员--}}
                            <td><small>{{$customer->jingjia_user_id?$users[$customer->jingjia_user_id]:''}}</small></td>

                            <td><small data-toggle="tooltip" data-placement="top" title="{{$customer?'添加时间：'.$customer->created_at:''}}">{{$customer->zixun_at?$customer->zixun_at:''}}</small></td>
                            <td><small>{{$customer->yuyue_at?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$customer->yuyue_at)->toDateString():''}}</small></td>
                            <td><small>{{$customer->time_slot?$customer->time_slot:''}}</small></td>
                            <td><small>{{$customer->arrive_at?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$customer->arrive_at)->toDateString():''}}</small></td>

                            {{--最近回访日期--}}
                            <td class="created_at"><small>{{$customer->huifangs->last()&&$customer->huifangs->last()->created_at?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$customer->huifangs->last()->created_at)->toDateString():''}}</small></td>
                            {{--最近回访人--}}
                            <td class="now_user"><small>{{$customer->huifangs->last()?$users[$customer->huifangs->last()->now_user_id]:''}}</small></td>
                            {{--下次回访日期--}}
                            <td class="next_at"><small>{{$customer->huifangs->last()&&$customer->huifangs->last()->next_at?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$customer->huifangs->last()->next_at)->toDateString():''}}</small></td>
                            {{--下次回访人--}}
                            <td class="next_user"><small>{{$customer->huifangs->last()&&$customer->huifangs->last()->next_user_id?$users[$customer->huifangs->last()->next_user_id]:''}}</small></td>
                            {{--<客户类型--}}
                            <td style="display: none;"><small>{{$customer->customer_type_id?$customertypes[$customer->customer_type_id]:''}}</small></td>
                            {{--备注--}}
                            <td style="display: none;">{{$customer->addons?$customer->addons:''}}</td>
                            <td class="huifang-cloumn">
                                @if($enableViewHuifang)
                                    @if($customer->huifangs->count()<2||\Carbon\Carbon::now()>\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$customer->huifangs->last()->created_at)->addDays(4))
                                        <a href="javascript:void(0);" data-id="{{$customer->id}}" data-toggle="modal" data-target="#huifangModal"  class="hf-btn text-red" ><small>未回访</small></a>
                                    @else
                                        <a href="javascript:void(0);" data-id="{{$customer->id}}" data-toggle="modal" data-target="#huifangModal" class="hf-btn text-blue"><small>已回访</small></a>
                                    @endif
                                @endif
                            </td>
                            <td class="opreation-cloumn">
                                @if($enableRead)
                                <a href="javascript:void(0);" data-id="{{$customer->id}}"
                                   data-tel="{{\App\Aiden::phoneCheck($customer->tel,$customer->customer_condition_id,$enableViewPhone,$isAdmin,3,$customer->user_id,$customer->arrive_at)}}"
                                   data-wechat="{{\App\Aiden::wechatCheck($customer->wechat,$customer->customer_condition_id,$enableViewWechat,$isAdmin,3,$customer->user_id,$customer->arrive_at)}}"
                                   class="detail-btn" data-toggle="modal" data-target="#detailModal" title="查看">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endif
                                @if($enableUpdate)
                                 <a href="{{route('zxcustomers.edit',$customer->id)}}?parameters={{isset($parameters)?json_encode($parameters):''}}"  alt="编辑" title="编辑"><i class="fa fa-edit"></i></a>
                                @endif
                                @if($enableDelete)
                                    <a href="javascript:void(0);"  alt="删除" data-id="{{$customer->id}}" title="删除" class="delete-operation"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
        </div>
        <!-- /.box-body -->
    </form>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/asset/layer/layer.js"></script>
    <script type="text/javascript" src="/asset/laydate/laydate.js"></script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();

        $(document).ready(function() {
            $("#search-form .form-group").hover(function () {
                $(this).children('.form-tips').show();
            },function () {
                $(this).children('.form-tips').hide();
            });
            $("#search-form .form-tips .qdate").click(function () {
                var start=$(this).data('start');
                var end=$(this).data('end');
                $(this).parent('.form-tips').parent('.form-group').children('input').eq(0).val(start);
                $(this).parent('.form-tips').parent('.form-group').children('input').eq(1).val(end);
            });
            $(".form-reset").click(function () {
                document.getElementById("search-form").reset();
            });
            $(".form-empty").click(function () {
                $("#search-form :input").not(":button, :submit, :reset, :hidden").val("").removeAttr("checked").remove("selected");//核心
            });
            $("#strlimit").click(function () {
                var elementsitems=$(".strlimit");
                for (var i=0;i<elementsitems.length;i++){
                    $(".strlimit").eq(i).html($(".strlimit").eq(i).data('title'));
                }
            });
            $('#zxcustomers-list-table').DataTable({
                "order": [[ 0, "desc" ]],
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
                "language": {
                    "url": "/datables-language-zh-CN.json"
                }
            });
            $("#searchOfficeId").on('change',function(){
                var officeId=$(this).val();
                $.ajax({
                    url: '/api/get-diseases-from-office',
                    type: "post",
                    data: {'office_id':officeId,'_token': $('input[name=_token]').val()},
                    success: function(data){
                        $("#searchDiseaseId").empty();
                        if(data.status){
                            var html='<option value="">--选择病种--</option>';
                            html += "<optgroup label=\""+data.data['name']+"\">";
                            for (var i=0;i<data.data['diseases'].length;i++){
                                html += "<option value=\""+data.data['diseases'][i].id+"\">"+data.data['diseases'][i].display_name+"</option>";
                            }
                            html += "</optgroup>";
                            $("#searchDiseaseId").append(html);
                        }
                    }
                });
            });
            $(".delete-operation").on('click',function(){
                var id=$(this).attr('data-id');
                layer.open({
                    content: '你确定要删除吗？',
                    btn: ['确定', '关闭'],
                    yes: function(index, layero){
                        $('form.zxcustomers-form').attr('action',"{{route('zxcustomers.index')}}/"+id);
                        $('form.zxcustomers-form').submit();
                    },
                    btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    },
                    cancel: function(){
                        //右上角关闭回调
                        //return false; 开启该代码可禁止点击该按钮关闭
                    }
                });
            });
            //快捷查询今日应回访
            $("#todayhuifang").click(function () {
                $("#search-form :hidden[name=quickSearch]").val('todayhuifang');
                $("#search-form").submit();
            });
            $("#todayarrive").click(function () {
                $("#search-form :hidden[name=quickSearch]").val('todayarrive');
                $("#search-form").submit();
            });
            $("#todayyuyue").click(function () {
                $("#search-form :hidden[name=quickSearch]").val('todayyuyue');
                $("#search-form").submit();
            });
            $("#todayarrived").click(function () {
                $("#search-form :hidden[name=quickSearch]").val('todayarrived');
                $("#search-form").submit();
            });
        } );
        //
        $(".keywordsContent").on('click',function () {
            var content=$(this).attr('title');
            $("#keywordsContentContent").html(content);
        });

        //
        @isset($todayHuifang)
        layer.msg(
            '<p>今日应回访：<span class="label bg-green">{{isset($todayHuifang)?$todayHuifang:''}}</span>人，已回访：<span class="label bg-green">{{$todayHuifangFinished}}</span>人</p><p>今日应到院：<span class="label bg-primary">{{isset($todayArrive)?$todayArrive:''}}</span>人',
            { offset:'rt',time: 5000}
            )
        @endisset
    </script>
    <!-- 回访modal -->
    <div class="modal fade" id="huifangModal" tabindex="-1" role="dialog" aria-labelledby="huifangModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="huifangModalLabel">回访记录</h4>
                </div>
                <div class="modal-body">
                    <div id="huifangrecords">
                        <p>加载中...</p>
                    </div>
                    <form class="form-horizontal">
                        <div class="huifang-add" id="huifang-add">
                            <input type="hidden" name="customer_id" value="">
                            <h3 class="text-center">本次回访</h3>
                            <div class="form-group">
                                <label for="customerId" class="col-sm-2 control-label">患者</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="customerName" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group {{empty($errors->first('next_at'))?'':'has-error'}}">
                                <label for="next_at" class="col-sm-2 control-label">下次回访时间</label>
                                <div class="col-sm-10">
                                    <input type="text" name="next_at" id="next_at" class="form-control" id="next_at" >
                                </div>
                                <script type="text/javascript">
                                    laydate.render({
                                        elem: '#next_at',
                                        type: 'datetime'
                                    });
                                </script>
                            </div>
                            <div class="form-group {{empty($errors->first('next_at'))?'':'has-error'}}">
                                <label for="next_user_id" class="col-sm-2 control-label">下次回访人</label>
                                <div class="col-sm-10">
                                    <select name="next_user_id" id="next_user_id" class="form-control">
                                        <option value="" selected="selected">--选择--</option>
                                        @foreach($zxusers as $k=>$user)
                                            <option value="{{$k}}">{{$user}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group {{empty($errors->first('description'))?'':'has-error'}}">
                                <label for="next_user_id" class="col-sm-2 control-label">回访内容</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    @if($enableHuifang)
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="hf_submit">提交回访</button>
                    @endif
                </div>
            </div>
            <script type="text/javascript">
                $(".huifang-cloumn").delegate('.hf-btn','click',function () {
                    $("#huifang-add input:hidden[name=customer_id]").val('');
                    $("#huifang-add input[name=next_at]").val('');
                    $("#huifang-add select[name=next_user_id]").val('');
                    $("#huifang-add textarea[name=description]").val('');
                    var customer_id =$(this).attr('data-id');
                    $.ajax({
                        url: '/api/get-huifangs-from-customer',
                        type: "post",
                        data: {'zx_customer_id':customer_id,'_token': $('input[name=_token]').val()},
                        success: function(data){
                            $("#customerName").val(data.customer);
                            $("#huifang-add input:hidden[name=customer_id]").val(data.customer_id);
                            var html="<h3 class=\"text-center text-danger\">"+data.customer+"</h3>";
                            if(data.status){
                                for (var i=0;i<data.data.length;i++){
                                    html += "<h5 class=\"text-center text-blue\">时间："+data.data[i]['now_at']+"</h5>";
                                    html += "<table class=\"table table-bordered\">";
                                    html += "<tr>";
                                    html += "<td style=\"width: 10%;\"><b>回访人</b></td>";
                                    html += "<td  style=\"width: 90%;\">"+data.data[i]['user']+"</td>";
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "<td style=\"width: 10%;\"><b>回访内容</b></td>";
                                    html += "<td style=\"width: 90%;\">"+data.data[i]['content']+"</td>";
                                    html += "</tr>";
                                    html += "</table>";
                                }
                                $("#huifangrecords").html(html);
                            }else{
                                $("#huifangrecords").html("<p class='text-center'>无回访记录！</p>");
                            }
                        }
                    });
                });
                //提交回访
                $("#hf_submit").click(function () {
                    var customer_id =$("#huifang-add input:hidden[name=customer_id]").val();
                    var next_at =$("#huifang-add input[name=next_at]").val();
                    var next_user_id =$("#huifang-add select[name=next_user_id]").val();
                    var description =$("#huifang-add textarea[name=description]").val();
                    $.ajax({
                        url:'{{route('huifangs.store')}}',
                        type: "post",
                        data: {'zx_customer_id':customer_id,'next_at':next_at,'next_user_id':next_user_id,'description':description,'_token': $('input[name=_token]').val()},
                        success: function(data){
                            if(data.status){
                                $("#customer-"+data.customer_id+" .huifang-cloumn a").removeClass("text-red").addClass("text-blue");
                                $("#customer-"+data.customer_id+" .huifang-cloumn a").html("已回访");
                                $("#customer-"+data.customer_id+" .created_at").html(data.created_at);
                                $("#customer-"+data.customer_id+" .now_user").html(data.now_user);
                                $("#customer-"+data.customer_id+" .next_at").html(data.next_at);
                                $("#customer-"+data.customer_id+" .next_user").html(data.next_user);
                            }
                        }
                    });
                });
                lay('.date-item').each(function(){
                    laydate.render({
                        elem: this
                        ,trigger: 'click'
                    });
                });
            </script>
        </div>
    </div>
    <!-- 详情modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="detailModalLabel">患者详情</h4>
                </div>
                <div class="modal-body" id="detailContent">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
            <script type="text/javascript">
                $(".opreation-cloumn").delegate('.detail-btn','click',function () {
                 var customer_id =$(this).attr('data-id');
                 var tel=$(this).attr('data-tel');
                 var wechat=$(this).attr('data-wechat');
                    $.ajax({
                        url: '/api/get-detail-from-customer',
                        type: "post",
                        data: {'zx_customer_id':customer_id,'_token': $('input[name=_token]').val()},
                        success: function(data){
                            $("#detailModalLabel").html(data.data.name);
                            var html="";
                            if(data.status){
                                html += "<table class=\"table table-bordered\">";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>姓名</b></td>";
                                html += "<td  style=\"width: 90%;\">"+data.data.name+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>性别</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.sex+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>年龄</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.age+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>电话</b></td>";
                                html += "<td style=\"width: 90%;\">"+tel+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>QQ</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.qq+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>微信</b></td>";
                                html += "<td style=\"width: 90%;\">"+wechat+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>商务通ID</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.idcard+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>搜索关键词</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.keywords+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>所在城市</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.city+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>媒体来源</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.media+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>网站类型</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.webtype+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>咨询员</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.user+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>当班竞价</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.jingjia_user+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>未预约原因</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.cause+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>咨询病种</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.disease+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>预约医生</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.doctor+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>咨询时间</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.zixun_at+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>预约时间</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.yuyue_at+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>时段</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.time_slot+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>到院时间</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.arrive_at+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>客户类型</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.customer_type+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>状态</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.customer_condition+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>备注</b><d>";
                                html += "<td style=\"width: 90%;\">"+data.data.addons+"</td>";
                                html += "</tr>";
                                html += "<tr>";
                                html += "<td style=\"width: 10%;\"><b>咨询内容</b></td>";
                                html += "<td style=\"width: 90%;\">"+data.data.description+"</td>";
                                html += "</tr>";
                                html += "</table>";
                                $("#detailContent").html(html);
                            }else{
                                $("#detailContent").html("<p class='text-center'>无</p>");
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>

    <div class="modal fade" id="sendMsg" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="msgModalLabel">发送短信</h4>
                </div>
                <div class="modal-body" id="msgContent">
                    <p class="text-center" id="msgTel"></p>
                    <form class="form-inline msgForm">
                        <div class="form-group">
                            <input type="hidden" name="customer"  class="form-control-plaintext"  id="msgCustomer" value="">
                            <input type="hidden" name="office"  class="form-control-plaintext"  id="msgOffice" value="">
                            <input type="text" name="name"  class="form-control-plaintext" style="margin-bottom: 1rem;" id="msgName" value="" placeholder="王先生">，您好，您已成功预约
                            <input type="text" name="doctor" class="form-control-pintext" style="margin-bottom: 1rem;" id="msgDoctor" valu="" placeholder="张教授">诊号：
                            <input type="text" name="number" class="form-control-pintext" style="margin-bottom: 1rem;" id="msgNumber" value="" placeholder="A001">，预约时间
                            <input type="text" name="date" class="form-control-pintext" style="margin-bottom: 1rem;" id="msgDate" value="" placeholder="2018年10月8日 上午10点">，请准时就诊。就诊流程：在一楼挂号处核对信息取号,按导医指导就诊即可。遇特殊情况请您提前电话告知我们！电话：0731-84146677，地址：湖南省长沙市芙蓉区东二环一段1178号。
                        </div>
                        <button type="button" class="btn btn-primary" id="msgSubmit" style="margin-top: 2rem;">发送</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".sendMsg").on('click',function () {
            var office=$(this).data('office');
            if (office==5||office=='5'){
                $("#msgTel").html($(this).data('tel'));
                $("#sendMsg input[name=name]").val($(this).data('name'));
                $("#sendMsg input[name=customer]").val($(this).data('customer'));
                $("#sendMsg input[name=office]").val(office);
                $('#sendMsg').modal('show');
            }
        });
        $("#msgSubmit").click(function () {
            var name=$("#sendMsg input[name=name]").val();
            var tel=$("#msgTel").html();
            var doctor=$("#sendMsg input[name=doctor]").val();
            var number=$("#sendMsg input[name=number]").val();
            var date=$("#sendMsg input[name=date]").val();
            var office=$("#sendMsg input[name=office]").val();
            var customer=$("#sendMsg input[name=customer]").val();
            if (name&&tel&&doctor&&number&&date){
                $.ajax({
                    url: '/api/send-notice-to-customer',
                    type: "post",
                    data: {'name':name,'tel':tel,'doctor':doctor,'number':number,'date':date,'office':office,'customer':customer, '_token': $('input[name=_token]').val()},
                    success: function(data){
                        if(data.Code.toUpperCase()=='OK'){
                            $('#sendMsg').modal('hide');
                            layer.msg(
                                'success！'+data.Message,
                                { offset:'auto',time: 5000}
                            )
                        }else{
                            $('#sendMsg').modal('hide');
                            layer.msg(
                                'error！'+data.Message,
                                { offset:'auto',time: 5000}
                            )
                        }
                    }
                });
            }
        });
    </script>
    <div class="modal fade" id="keywordsContent" tabindex="-1" role="dialog" aria-labelledby="keywordsContentModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="keywordsContentModalLabel">关键字</h4>
                </div>
                <div class="modal-body" id="keywordsContentContent">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection
