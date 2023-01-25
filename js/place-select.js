jQuery(document).ready(function ($) {
    $(".js_field-city option").hide();
  
    //Required to biding after billing-edit click
    $(".edit_address").one("click", function () {
      filterCities();
    });
  
    //Required to avoid unbiding after Country change
    $(".js_field-country").on("select2:select", function (evt) {
      filterCities();
    });
  
    filterCities = () => {
      $(".js_field-state").on("select2:select", function (evt) {
        var state = $(this).select2("data")[0].id;
        $(".js_field-city option").hide();
        $(".js_field-city option[value^='" + state + "']").show();
        $(".js_field-city").val(null);
      });
    };
  });