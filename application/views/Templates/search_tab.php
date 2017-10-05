<?php


         $res= $this->session->userdata('searchResult');
         $business=$res['business'];
         $city=$res['city'];
        
     ?>
<div class="container" ng-controller='checkRating'>
    <div class="row">
      <form id="searchForm" method="get" action="<?php echo base_url();?>SearchResult/result" >
      <div class="yp-top-search-bar">
        <div class="col-md-4 padding-r0">
          <div class="bsearch_business" >
          <input class="yp-search-input" id="bbusiness" autocomplete="off" name="business"  type="text" value="<?php echo $business;?>"  placeholder="Business Name">
         <ul class="dropdown-menu txtbbusiness lefft"  id="DropdownbBusiness" role="menu" aria-labelledby="dropdownMenu">
                       <li class="zip_md"> &nbsp;Search by businessname,Or category</li>

                     </ul>
        </div>
           
        </div>
        <div class="col-md-2">
          <div class="yp-near">Near</div>
        </div>
        <div class="col-md-4 padding-l0">
          <div class="bsearch" >
          <input class="yp-loc-input" id="bcountry" autocomplete="off" name="city" value="<?php echo $city;?>" type="text" placeholder="Place">
         <ul  class="results  dropdown-menu txtbcountry full " id="DropdownbCountry"  role="menu" aria-labelledby="dropdownMenu">
                       
                       
                     </ul>
                 </div>
          
                 
        </div>
         <input type="hidden" name="from_type" id="fromType">
                  <input type="hidden" name="latitude" id="latget"> 
                  <input type="hidden" name="image" id="photos">
                  <input type="hidden" name="rating" id="ratingGet">
                   <input type="hidden" name="longitude" id="lon"> 
                    <input type="hidden" name="place_id" id="id"> 

        <div class="col-md-2">
          <button type="submit" class="yp-find-btn">Find</div>
      </div>
      </form> 
    </div>
  