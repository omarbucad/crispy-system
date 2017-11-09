$(document).on("click" , '.add-tag-btn' , function(){

	$("#add_tags_modal").modal("show");
	
});

$(document).on("click" , '.view-outlet' , function(){
	var $me = $(this);

	if($me.find("span").text() == "View taxes by outlet"){
		$me.find("span").text("Hide taxes by outlet");
		$me.find("i").removeClass("fa-caret-down").addClass("fa-caret-up");
		$("#outlet-table").removeClass("hide");
	}else{
		$me.find("span").text("View taxes by outlet");
		$me.find("i").removeClass("fa-caret-up").addClass("fa-caret-down");
		$("#outlet-table").addClass("hide");
	}
});

$(document).on('change' , '.compute-sales-tax-wot' , function(){

	if($(this).val() == "DEFAULT"){
		var rate = parseFloat($(this).data("default"));
		$(this).closest(".row").find(".sales-tax-span").fadeIn();
	}else{
		var rate = parseFloat($(this).find(":selected").data("rate"));
		$(this).closest(".row").find(".sales-tax-span").fadeOut();
	}

	var retail_price = parseFloat($(".retail_price_1").val());

	var tax_amount = parseFloat(retail_price * (rate / 100));
	var retail_price_with_tax = parseFloat(retail_price + tax_amount).toFixed(2);

	$(this).closest("tr").find(".tax_amount").text(tax_amount.toFixed(2));
	$(this).closest("tr").find(".retail_price").text(retail_price_with_tax);
	$(this).closest("tr").find(".retail_price").val(retail_price_with_tax);

});

$(document).on('change' , '.compute-sales-tax-wt' , computeSales);



function computeSales2(){
	$.each( $(".compute-sales-tax-wot") , function(k , v){

		if($(v).val() == "DEFAULT"){
			var rate = parseFloat($(v).data("default"));
			$(v).closest(".row").find(".sales-tax-span").fadeIn();
		}else{
			var rate = parseFloat($(v).find(":selected").data("rate"));
			$(v).closest(".row").find(".sales-tax-span").fadeOut();
		}

		var retail_price = parseFloat($(".retail_price_1").val());

		var tax_amount = parseFloat(retail_price * (rate / 100));
		var retail_price_with_tax = parseFloat(retail_price + tax_amount).toFixed(2);

		$(v).closest("tr").find(".tax_amount").text(tax_amount.toFixed(2));
		$(v).closest("tr").find(".retail_price").text(retail_price_with_tax);
		$(v).closest("tr").find(".retail_price").val(retail_price_with_tax);
	});
}

function computeSales(){

	if($(".compute-sales-tax-wt").val() == "DEFAULT"){
		var rate = parseFloat($(".compute-sales-tax-wt").data("default"));
		$(".sales-tax-span").fadeIn();
	}else{
		var rate = parseFloat($(".compute-sales-tax-wt").find(":selected").data("rate"));
		$(".sales-tax-span").fadeOut();
	}

	var retail_price = parseFloat($(".retail_price_1").val());
	var tax_amount = parseFloat(retail_price * (rate / 100));

	$(".compute-sales-tax-wt").parent().find("span").text(tax_amount.toFixed(2));
	$(".retail_price_2").val(parseFloat(retail_price + tax_amount).toFixed(2));
}

$(document).on('click' , '.apply-all' , function(){
	var className = $(this).data("class");
	$(className).val($(this).closest("td").find("input").val());
});

$(document).on('click' , '.add-attribute' , function(){
	var table = $(this).parent().find("table");
	var clone = table.find("tbody > tr:first-child").clone();

	clone.find(".input-group-btn").css("visibility" , "visible");
	clone.find(".bootstrap-tagsinput").remove();
	clone.find(".tags-input").tagsinput();

	if(table.find("tbody > tr").length == 2){
		$(this).addClass("hide");
		table.find("tbody").append(clone);
	}else{
		table.find("tbody").append(clone);
	}
});

$(document).on("click" , '.remove-attribute' , function(){
	$(this).closest("tr").fadeOut("slow").remove();
	$(".add-attribute").removeClass("hide");
});

$(document).on("click" , '.product-type-btn' , function(){
	$(".product-type-btn").removeClass("active");
	$(this).addClass("active");

	$("#product_type").val($(this).data("type"));

	if($(this).data("type") == "STANDARD"){
		$(".standard_product").fadeIn();
		$(".composite_product").fadeOut();

	}else{
		$(".standard_product").fadeOut();
		$(".composite_product").fadeIn();
	}
});

$(document).on('change' , '.select-attribute' , function(){
	if($(this).val() == "ADD_ATTRIBUTE"){
		$('#add_attribute_modal').modal("show");
	}
});

$(document).on("click" , '.submit-form-ajax' , function(){
	var $me = $(this);
	var form = $me.closest(".modal").find("form");
	var action = form.attr("action");

	$.ajax({
		url : action ,
		method : "POST" ,
		data : form.serialize(),
		success : function(response){
			var json = jQuery.parseJSON(response);

			if(json.status){
				$(".select-attribute").append($("<option>" , {
					value : attribute_name ,
					text : attribute_name ,
					selected : true
				}));

				$me.closest(".modal").modal("hide");
			}
		}
	});
});

$(document).on("click" , '.submit-form-ajax-tags' , function(){
	var $me = $(this);
	var form = $me.closest(".modal").find("form");
	var action = form.attr("action");

	$.ajax({
		url : action ,
		method : "POST" ,
		data : form.serialize(),
		success : function(response){

			var newStateVal = form.find("#tag_name").val();
	
		    if ($("#select_tags").find("option[value=" + newStateVal + "]").length) {
		      	$("#select_tags").val(newStateVal).trigger("change");
		    } else { 
		        var newState = new Option(newStateVal, newStateVal, true, true);
		        $("#select_tags").append(newState).trigger('change');
		    } 

			$me.closest(".modal").modal("hide");
		}
	});
});

$(document).ready(function(){

	$("#product_variant").hide();
	$(".composite_product").hide();

	$(".track_inventory").bootstrapSwitch({
		size: "mini" ,
		onSwitchChange : function(event , state){
			if(state){
				if($(".has_variant").is(":checked")){
					$("#product_inventory_table").fadeOut();
				}else{
					$("#product_inventory_table").fadeIn();
				}
			}else{
				$("#product_inventory_table").fadeOut();
			}
		}
	});
	$(".has_variant").bootstrapSwitch({
		size: "mini" ,
		onSwitchChange : function(event , state){
			if(state){
				if($(".track_inventory").is(":checked")){
					$("#product_inventory_table").fadeOut();
				}

				$("#product_variant").fadeIn();
				$(".product_inventory_table").fadeOut();
			}else{
				if($(".track_inventory").is(":checked")){
					$("#product_inventory_table").fadeIn();
				}
				$("#product_variant").fadeOut();
				$(".product_inventory_table").fadeIn();
			}
		}
	});
});