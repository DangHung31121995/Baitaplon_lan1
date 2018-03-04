// $(function() {
//     $('#txtSearch').on('keyup',function(){
//         var content=$(this).val();
//         // $.post('index.php?controller=LOAIPHONG&action=timkiem',{query:content},function(data){
//         //     alert(data);
//         //     // var object=JSON.parse(data);
//         //     // //rows.empty();	
            
//         //     // $.each(object,function(i, val){
//         //     //     var str = '<li item-id="' + val.Id + '">' 
//         //     //                + val.Id + ' - ' + val.username 
//         //     //                + '<a href="#">Xoa</a>' 
//         //     //                + '</li>';
//         //     //                $('#rows').empty();
//         //     //     $('#rows').append(str);
//         //     // });
            
//         //     alert(data);
//         //   });
//         $.ajax({
//             url: "http://localhost:8080/QuanLyKhachSan/index.php?controller=LOAIPHONG&action=timkiem",
//             type: "post",
//             data: {
//                 query: content
//             },
//             success : function(data){
//                 alert(data)
//             }
//         })
//      })
// });