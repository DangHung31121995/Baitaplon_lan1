(function($){
      
       $.fn.pagnition=function(options)
       {
       	//các giá trị mặc định options
              var default={
              	  "rows":"#rows",
              	   "pages":"#pages",
              	   "items":6,
              	   "height":27,
              	   "currentPage":1,
              	   "total":0,
              	   "btnPrevious":".goPrevious",
              	    "btnNext":".goNext",
              	    "txtCurrentPage":"#currentPage"
              };
         //end 
         //mảng các plugin
         options=$.extend(default,options);
         console.log(typeof)
         //end 
         //
         var rows=$(options.rows);


              
       }
})(jQuery);