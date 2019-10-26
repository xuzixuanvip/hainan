
			                        
                        			
    <table class="table table-hover">
        <thead>
			<tr>
				<th>ID
					</th>
						<th>姓名</th>
                        <th>手机号码</th>
                        <th>故障类别</th>
                        <th>故障地點</th>                       
                        <th>报修内容</th>
                        <th>报价</th>
                        
                          
                        <th>状态</th>
                         
						<th>报修时间</th>
                        <th>完成时间</th>
					    <th>处理结果</th> 
                        <th>客户评价</th>  
					</tr>
					</thead>
											
                    <tbody>

                    @foreach($list as $v)
                        <tr>
                            <td>
                                {{$v->id}}
                                                        
                                                      
                            </td>
                                                    
            <td>
                {{$v->customer_name}}
            </td>
                                    
            <td>
                            {{$v->mobile}}
                                    </td>

                                                   
                                                    
                                    <td>
                                {{object_get($v,'category.name')}}
                                                    </td>
                                <td>
                                {{object_get($v,'depart.name')}} {{$v->address}}
                                                    </td>

                                <td>{{$v->content}}</td>                  
                                <td>{{$v->money}}</td>                    
                                                    
                                                    <td>
                                                   
    <a  class="btn-sm btn btn-{{$taskStatus[$v->status]['style']}} btn-custom">{{$taskStatus[$v->status]['txt']}}</a>
                                                        
                                                    </td>
                                                    <td>
                                                        {{$v->created_at}}
                                                    </td>
                                                    <td>
                                                        {{$v->end_time}}
                                                    </td>
                                                    <td>{{$v->end_result}}</td>
                                                    <td>

                                                    {{object_get($v,'comment.point','未评').'分'}}
                                                @if(object_get($v,'comment.remark'))    
                                                ,{{object_get($v,'comment.remark')}}
                                            @endif</td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                  