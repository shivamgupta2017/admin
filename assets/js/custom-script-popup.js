//category popup
$(function(){
$('.show-catgetdetails').on("click", function(){
	var getcatdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-catModal .modal-catbody').html(loader);
    $('#popup-catModal').modal({show:true});
	$.ajax({		
				type: "POST",
				url: base_url+'Home_ctrl/catdetails_view',            
				data: {'getcatdetails':getcatdetails},
				cache: false,
				success: function(result)
				
				{
					
					$('#popup-catModal .modal-catbody').html(result);
					
				}
	});
})



//BoardPoint details view popup
$('.show-boardgetdetails').on("click", function(){
	var boarddetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-boardpointModal .modal-boardbody').html(loader);
    $('#popup-boardpointModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Borderpoint_details/view_boardpopup',
                
				data: {'boarddetails':boarddetails},
				cache: false,
				success: function(result)
				{
					$('#popup-boardpointModal .modal-boardbody').html(result);
				}
	});
})



//User details view popup
$('.show-usergetdetails').on("click", function(){
	var userdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-usergetModal .modal-userbody').html(loader);
    $('#popup-usergetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'User_ctrl/view_userpopup',
				data: {'userdetails':userdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-usergetModal .modal-userbody').html(result);
				}
	});
})

$('.show-concern').on("click", function(){
	var userdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-concern .modal-concern_body').html(loader);
    $('#popup-concern').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Concern_ctrl/concern_popup',
				data: {'userdetails':userdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-concern .modal-concern_body').html(result);
				}
	});
})
$('.show-vendorModel').on("click", function(){

	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-addvendor .modal-vendorBody').html(loader);
    $('#popup-addvendor').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Purchase_ctrl/add_vendor_popup',
				data: {},
				cache: false,
				success: function(result)
				{
					$('#popup-addvendor .modal-vendorBody').html(result);
				}
	});
})
//Subcategory details view popup 
$('.show-subcatgetdetails').on("click", function(){
	var subcatdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-subcatgetModal .modal-subcatbody').html(loader);
    $('#popup-subcatgetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Home_ctrl/subcatdetails_view',
                
				data: {'subcatdetails':subcatdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-subcatgetModal .modal-subcatbody').html(result);
				}
	});
})
//view product popup
$('.show-progetdetails').on("click", function(){
	var prodetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-progetModal .modal-probody').html(loader);
    $('#popup-progetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Product_ctrl/view_product_popup',
                
				data: {'prodetails':prodetails},
				cache: false,
				success: function(result)
				{
					$('#popup-progetModal .modal-probody').html(result);
				}
	});
})
//view promocode popup
$('.show-promogetdetails').on("click", function(){
	var promodetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-promogetModal .modal-promobody').html(loader);
    $('#popup-promogetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Promocode_ctrl/promodetails_view',
                
				data: {'promodetails':promodetails},
				cache: false,
				success: function(result)
				{
					$('#popup-promogetModal .modal-promobody').html(result);
				}
	});
})
//view city popup
$('.show-citygetdetails').on("click", function(){
	var citydetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-citygetModal .modal-citybody').html(loader);
    $('#popup-citygetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Store_ctrl/citydetails_view',
                
				data: {'citydetails':citydetails},
				cache: false,
				success: function(result)
				{
					$('#popup-citygetModal .modal-citybody').html(result);
				}
	});
})
//view store popup
$('.show-storegetdetails').on("click", function(){
	var storedetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-storegetModal .modal-storebody').html(loader);
    $('#popup-storegetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Store_ctrl/storedetails_view',
                
				data: {'storedetails':storedetails},
				cache: false,
				success: function(result)
				{
					$('#popup-storegetModal .modal-storebody').html(result);
				}
	});
})


//Customer details view popup
$('.show-customergetdetails').on("click", function(){
	var customerdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-customergetModal .modal-customerbody').html(loader);
    $('#popup-customergetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Customer_ctrl/view_customer',
                
				data: {'customer_details':customerdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-customergetModal .modal-customerbody').html(result);
				}
	});
})

$('.show-verifyorder').on("click", function(){
	var customerdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-verifyModel .modal-verifyBody').html(loader);
    $('#popup-verifyModel').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Order_ctrl/verification',       
				data: {'customer_details':customerdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-verifyModel .modal-verifyBody').html(result);
				}
	});
})

$('.show-customerShip').on("click", function(){
	var customerdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-customership .modal-customershipbody').html(loader);
    $('#popup-customership').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Customer_ctrl/shipping_popup',
                
				data: {'customer_details':customerdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-customership .modal-customershipbody').html(result);
				}
	});
})

$('.show-updateordergetdetails').on("click", function(){
	var orderdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-updateordergetModal .modal-updateorderbody').html(loader);
    $('#popup-updateordergetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Order_ctrl/update_order_popup',
                
				data: {'orderdetails':orderdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-updateordergetModal .modal-updateorderbody').html(result);
				}
	});
})

//Order details view popup
$('.show-ordergetdetails').on("click", function(){
	var orderdetails = $(this).attr("data-id");
	var loader = '<p class="text-center"><img src="'+base_url+'assets/images/ajax-loader-4.gif" /></p>';
    $('#popup-ordergetModal .modal-orderbody').html(loader);
    $('#popup-ordergetModal').modal({show:true});
	$.ajax({	        
				type: "POST",
				url: base_url+'Order_ctrl/view_order',
                
				data: {'orderdetails':orderdetails},
				cache: false,
				success: function(result)
				{
					$('#popup-ordergetModal .modal-orderbody').html(result);
				}
	});
})

  
   
   

});

// Select Box 				   
$(document).ready(function() {			
				 
$(".js-example-basic-multiple").select2();   
				   
});


function load_map() {
	
	var map = new google.maps.Map(document.getElementById('map_canvas'), {
						zoom: 7,
						center: new google.maps.LatLng(35.137879, -82.836914),
						mapTypeId: google.maps.MapTypeId.HYBRID
					});
					
	var myMarker = new google.maps.Marker({
		position: new google.maps.LatLng(9.369, 76.803),
		draggable: true
	});
	
    var latitude = document.getElementById('pick-lat');
	var longitude = document.getElementById('pick-lng');
	
	google.maps.event.addListener(myMarker, 'dragend', function (evt) {
		document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
		latitude.value = evt.latLng.lat().toFixed(3);
		longitude.value = evt.latLng.lng().toFixed(3);
	});
	
	google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
		document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
	});
	
	map.setCenter(myMarker.position);
	myMarker.setMap(map);
}

////RATING VALUES GET
function rating() {
	
$('.raty').each(function() {
    var rate = $(this).data("rate");
   $(this).raty({
        readOnly: true,
       score: rate //default stars
   });
    });
}

//Board Point Add and Edit Select box values get

 $("#category_details").change(function()
  {  
	var id=$(this).val();
    var dataString =id;
	$.ajax({
			 type: "POST",
			 url:base_url+'Shopper_ctrl/add_categorydetailsget',
			 data: {value:dataString},
			 cache: false,
		 	 success: function(data){

             $(".subcat").html(data);
			  $(".subcat").select2();
			 
	   }
	 });
   });

 $("#subcat_details").change(function()
  {  
	var id=$(this).val();
    var dataString =id;
	$.ajax({
			 type: "POST",
			 url:base_url+'Shopper_ctrl/add_productdetailsget',
			 data: {value:dataString},
			 cache: false,
		 	 success: function(data){

             $(".product").html(data);
			  $(".product").select2();
			 
	   }
	 });
   });
  
  


