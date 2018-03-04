// JavaScript Document
(function($){
	$.fn.zPaging = function(options){
				
			var defaults = {
				"rows"				: "#rows",
				"pages"				: "#pages",
				"items"				: 4,
				"height"			: 27,
				"currentPage"		: 1,
				"total"				: 0,
				"btnPrevious"		: ".goPrevious",
				"btnNext"			: ".goNext",
				"txtCurrentPage"	: "#currentPage",
				"pageInfo"			: ".pageInfo"
			};
		options = $.extend(defaults,options);
		
		//=============================================
		//Cac bien se su dung trong Plugin
		//=============================================
		var rows 			= $(options.rows);
		var pages 			= $(options.pages);
		var btnPrevious 	= $(options.btnPrevious);
		var btnNext 		= $(options.btnNext);
		var txtCurrentPage 	= $(options.txtCurrentPage);
		var lblPageInfo		= $(options.pageInfo);
		var aRows			= '';
		
		//=============================================
		//Khoi tao cac ham can thi khi Plugin duoc su dung
		//=============================================
		init();
	    setRowsHeight();
		
		//=============================================
		//Ham khoi dong
		//=============================================

        function init()
        {
			//var url	= "setValue.php?type=count&items=" + options.items;
			//var url="index.php?controller=LOAIPHONG&type=count&items="+options.items;
			$.ajax({
				type: "GET",
				dataType: "html",
				url: "index.php?controller=LOAIPHONG&action=count&items="+options.items, //Relative or absolute path to response.php file
				  success: function(data) {
				  alert(data);

				}
			  });
            // $.get(url,function(data,status,jqyHRQ)
            // {
			// 	alert(data);
				// var myobj = JSON.parse();
				// console.log(myobj);
				//console.log(typeof(data));
				//console.log(data);
			  //var object=JSON.parse(data);
			  //console.log(data);
                // options.total=object.total;
                // pageInfo();
                //  loadData(options.currentPage);
              

               
           //});
        //    setCurrentPage(options.currentPage);

        //    btnPrevious.on('click',function(e){
		// 	goPrevious();
		// 	e.stopImmediatePropagation();

        //    });
        //    btnNext.on('click',function(e){
        //     goNext();
        //     e.stopImmediatePropagation();
        //    });

        //    txtCurrentPage.on('keyup',function(e){
        //        if(e.keyCode == 13){
        //         var currentPageValue = parseInt($(this).val());
        //        // console.log(currentPageValue);	
        //         if(isNaN(currentPageValue) || currentPageValue <= 0 
        //                         || currentPageValue > options.total)
        //         {
        //             alert("Gia tri nhap vao khong phu hop");
        //         }
        //         else
        //         {
                   
        //              options.currentPage = currentPageValue;
        //              pageInfo();
        //              loadData(currentPageValue);
        //         }
        //     }
        //    });
			
          
			
		}
		
		//=============================================
		//Ham xu ly khi nhan vao nut btnPrevious
		//=============================================
		function goPrevious(){
			// console.log("goPrevious: " + options.currentPage);
			if(options.currentPage != 1){
				 var p = options.currentPage - 1;
				
				// options.currentPage = p;
				loadData(p);	
				setCurrentPage(p);
			// 	setCurrentPage(p);
			 	options.currentPage = p;
			 	pageInfo();
			}
		}
		
		//=============================================
		//Ham xu ly khi nhan vao nut btnNext
		//=============================================
		function goNext(){
			// console.log("goNext: " + options.currentPage);
			if(options.currentPage != options.total){
			 	var p = options.currentPage + 1;
			 	loadData(p);	
			 	setCurrentPage(p);
				options.currentPage = p;
			 	pageInfo();
			 }
        }
        
		
		//=============================================
		//Ham xu ly gan gia tri vao 
		//trong o textbox currentPage
		//=============================================
		function setCurrentPage(value){
			txtCurrentPage.val(value);
        }
        
		
		//=============================================
		//Ham hien thi thong tin phan trang
		//=============================================
		function pageInfo(){
			lblPageInfo.text("Page " + options.currentPage + " of " + options.total);
		}
		
		//=============================================
		//Thiet lap chieu cao cho ul#rows
		//=============================================
		function setRowsHeight(){
			var ulHeight = (options.items * options.height +13) + "px";
			 rows.css("height",ulHeight);
		}
		
		//=============================================
		//Ham load cac thong trong database va dua vao #row
		//=============================================
		function loadData(page){

            var url= "setValue.php?type=list";
           
            var value={
                "items":options.items,
               "currentPage":page
            }
            $.post(url,value,function(data,status){
               // console.log(data);
             
               if(data.length > 0)
               {
                     var object=JSON.parse(data);
                		rows.empty();	
                        
                		$.each(object,function(i, val){
                			var str = '<li item-id="' + val.Id + '">' 
                					   + val.Id + ' - ' + val.username 
                					   + '<a href="#">Xoa</a>' 
                					   + '</li>';
                			rows.append(str);
                		});
                        
                		//Lay tap hop cac the <a> nam ul#rows li
						aRows = options.rows + " li a";
						console.log(aRows);
                		//console.log(aRows);
                		$(aRows).on("click", function(e){						
							deleteItem(this);
						});
                	
                }
                   
            });
            
            
		}
		
		//=============================================
		//Xoa di mot dong trong #rows
		//=============================================
		function deleteItem(obj){
			 var parent = $(obj).parent();
			 //console.log(parent);
			var itemID = $(parent).attr("item-id");
			var lastRow=$(rows).children(":last").attr("item-id");

			console.log(lastRow);
			//console.log(itemID);
			$(parent).fadeOut({
				durarion:300,
				done:function()
				{
					$.ajax({
						type:"GET",
						url:"setValue.php?type=delete&id=" + itemID,
						dataType:"json"
						
					});
					if(itemID== lastRow && $(rows).children().length()==1)
					{
						options.currentPage=options.currentPage-1;
						
					}
					init();
					//pageInfo();
					$(this).remove();
				}		
			});
			var urls	= "setValue.php?type=one&id=" +lastRow;
			$.get(urls,function(data,status,jqyHRQ)
            {
				
			   if(data !=false)
			   {
				var str = '<li item-id="' + object.Id + '">' 
				+ object.Id + ' - ' + object.username 
				+ '<a href="#">Xoa</a>' 
				+ '</li>';
				str=$(str).hide().appendTo(rows);
				$(str).fadeIn(300);
			   }
			  
           });
			
			
		}
	}	
})(jQuery);

$(document).ready(function(e) {
     var obj = {'items':2};
	$("#paging").zPaging(obj);

	// $('.timkiem').on('keyup',function(){
	//   var txt=$(this).val();
	//   $.post('setValue.php',{data:txt},function(data){
	// 	var object=JSON.parse(data);
	// 	//rows.empty();	
		
	// 	$.each(object,function(i, val){
	// 		var str = '<li item-id="' + val.Id + '">' 
	// 				   + val.Id + ' - ' + val.username 
	// 				   + '<a href="#">Xoa</a>' 
	// 				   + '</li>';
	// 				   $('#rows').empty();
	// 		$('#rows').append(str);
	// 	});
	//   });
	// });
});





