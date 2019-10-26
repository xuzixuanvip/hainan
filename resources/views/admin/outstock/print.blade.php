<!DOCTYPE html>
<html>
<head>
  <title></title>
<style type="text/css">
  body{font-family: 宋体;font-size: 14px;}
  .title{font-size: 18px; text-align: center;}
  .m-b-10{clear: both;margin-bottom: 10px;}
  .m-b-15{clear: both;margin-bottom: 15px;}
   table,table tr th, table tr td { border:1px solid #000;text-align: center }
  table{width: 100%;border-collapse: collapse;};
  .textline{font-size: 12px;}

</style>
</head>
<body>
     <h5 class="title">东湖分院 事务处理中心 出库单</h5>
            <p class="textline">
              出库单号:{{$data->code}}&nbsp;&nbsp;&nbsp;提交时间:{{$data->created_at->format('Ymd H:i:s')}}&nbsp;&nbsp;&nbsp; 
              出库时间:{{$data->outed_at}}
            </p>                     
            <table class="m-b-15">
              
                <tr>
                  <td>姓名</td>
                  
                  <td>联系</td>
                  
                  <td>科室</td>
                
                  <td>用途</td>
                 
              
                </tr>
                <tr>
                 
                  <td>{{$data->name}}</td>
                  
                  <td>{{$data->phone}}</td>
                  
                  <td>{{object_get($data,'room.name')}}</td>
                 
                  <td>{{$data->arrived_at}}</td>
              
                </tr>                     
              </table>


              <table class="m-b-10">
                <tr>
                  <th colspan="9">材料清单</th>
                </tr>
                <tr>
                  <td>序号</td>
                   <td>材料名称</td>
                  <td>材料编号</td>
                 

                  <td>单位</td>
                  <td>数量</td>
                  
                  <td>价格</td>
                  
                 
                </tr>
                @foreach($data->goods as $key=>$p)
                <tr>
                  <td>{{$key+1}} </td>
                   <td>{{object_get($p,'goods.name')}}</td>
                  <td>{{object_get($p,'goods.source_code')}}</td>
                 
                  <td>{{object_get($p,'goods.unit')}}</td>
                  <td>{{$p->goods_num}}</td>
                 
                  <td></td>
                  
                  
                </tr>
                @endforeach
              
              </table>

             
              <p class="textline">
                管理员：_________ &nbsp;&nbsp;&nbsp;&nbsp;领取人：_________
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;备注：________
              </p>

          
</body>
</html>

          
                             
           
              
              
            
               

                  
            
        
       

           



    
        
    
