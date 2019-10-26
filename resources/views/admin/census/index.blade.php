
                                        <table class="table table-hover">
                                        	<thead>
												<tr>
													<th style="min-width: 35px;">
													ID
                                                        
													</th>
													<th>维修工</th>
													<th>任务量</th>
                          <th>收费</th>
                          <th>完成任务数</th>
                          <th>完成率</th>
                         
                         
												
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                                                    <td>
                                                        {{$v->id}}
                                                        
                                                      
                                                    </td>
                                                    
                                                    <td>
                                                        {{$v->username}}
                                                    </td>
                                                    <td>
                                                        {{$v->task_num}}
                                                    </td>
                                                    <td>
                                                        {{$v->money}}
                                                    </td>
                                                     <td>
                                                        {{$v->finish_num}}
                                                    </td>
                                                     <td>
                                                        {{$v->finish_rate}}
                                                    </td>
                                                    
                                                    
                                                    
                                                
                                                    
                                                   
                                                    
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                  