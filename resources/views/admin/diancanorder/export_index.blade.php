
			                        
                        			
    <table class="table table-hover">
        <thead>
			<tr>
				<th>ID</th>
						<th>商户名</th>
                        <th>用户</th>
                        <th>部门</th>
                        <th>金额</th>
                        <th>订餐时间</th>                       
                        <th>订单状态</th>
                       
					</tr>
					</thead>
											
                    <tbody>

                    @foreach($list as $v)
                        <tr>
                            <td>
                                {{$v->id}}
                                                        
                                                      
                            </td>
                                                    
            <td>
               {{object_get($v,'shop.name')}}
            </td>
                                    
            <td>
                            {{object_get($v,'user.name')}}
                                    </td>

            <td>
                {{object_get($v,'user.department')}}
            </td>                                       
                                                    
                                    <td>
                                {{$v->total_price}}
                                                    </td>
                              

                                <td>{{$v->status_txt}}</td>                  
                               
                                <td>{{$v->created_at}}                                             </td>
                                                  
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                  