

          
                             

                                 
            <table class="table table-hover">
               <!--  <tr>
                  <td>资产编号</td>
                  <td><strong>{{$data->title}}</strong></td>
                </tr> -->
                <tr>
                  <td>姓名</td>
                  <td>{{$data->customer_name}}</td>
                </tr>
                <tr>
                  <td>手机号</td>
                  <td>{{$data->mobile}}</td>
                </tr>
                <tr>
                  <td>报修类型</td>
                  <td>{{$data->category->name or ''}}</td>
                </tr>
                <tr>
                  <td>故障描述</td>
                  <td>{{$data->remark}}</td>
                </tr>
               
                <tr>
                  <td>当前状态</td>
                  <td><label class="label label-{{$taskStatus[$data->status]['style']}}">{{$taskStatus[$data->status]['txt']}}</label></td>
                </tr>
              </table>
          
              
              
            
               

                  
            
        
       

           



    
        
    
