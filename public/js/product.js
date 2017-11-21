var uniqId = (function(){
    var i=0;
    return function() {
        return i++;
    }
})();

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





$(document).on('click' , '.apply-all' , function(){
	var className = $(this).data("class");

	$(this).closest("table").find(className).val($(this).closest("td").find("input").val());
});

$(document).on('click' , '.add-attribute' , function(){
	var table = $(this).parent().find("#product_variant");
	var clone = table.find("tbody > tr:first-child").clone();

	clone.find(".input-group-btn").css("visibility" , "visible");
	clone.find(".bootstrap-tagsinput").remove();
	clone.find(".tags-input").tagsinput({
	  allowDuplicates: true
	});
	clone.find(".bootstrap-tagsinput > span").remove();


	$('.tags-input').on('itemAdded', function(event) {
	  	build_variant();
	});

	$('.tags-input').on('itemRemoved', function(event) {
	  	build_variant();
	});

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

$(document).on("click" , '.open-settings' , function(){
	if($(this).closest("tr").hasClass("active")){
		$(this).closest("tr").removeClass("active");
		$(this).closest("tr").next().removeClass("open").addClass("hidden");
		$(this).closest("td").find("i").removeClass("fa-caret-down").addClass("fa-caret-right");
	}else{
		$(this).closest("tr").addClass("active");
		$(this).closest("tr").next().addClass("open").removeClass("hidden");
		$(this).closest("td").find("i").removeClass("fa-caret-right").addClass("fa-caret-down");
	}
});

$(document).ready(function(){


	$("#variant_table tbody").append(build_variant_header(uniqId() , "Starbucks samsung"));
	$("#variant_table tbody").append(build_variant_body(uniqId()));


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

	$('.tags-input').on('itemAdded', function(event) {
	  	build_variant();
	});

	$('.tags-input').on('itemRemoved', function(event) {
	  	build_variant();
	});

	$(document).on("keypress", 'form', function (e) {
	    var code = e.keyCode || e.which;
	    if (code == 13) {
	        e.preventDefault();
	        return false;
	    }
	});
});





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

function build_variant(){

}


function build_variant_header(uniq_id , product_name){
	var tr = $("<tr>" , {class : "variant-head customer-row" , "data-id" : uniq_id});
	var span = $("<span>");

	var product_variant_name = $("<td>").append( span.append("<i class='fa fa-caret-right' aria-hidden='true'></i>") ).append( $("<strong>" , {style : "padding-left : 10px; " , text : product_name , class : "open-settings"}) );

	tr.append($("<td>").append(product_variant_name));
	tr.append($("<td>").append("<input type='text'  class='form-control' aria-describedby='sizing-addon1' placeholder='Enter SKU'>"));
	tr.append($("<td>").append("<input type='text'  class='form-control' aria-describedby='sizing-addon1' placeholder='Enter Supplier Code'>"));
	tr.append($("<td>").append('<div class="input-group"><span class="input-group-addon" id="sizing-addon1">₱</span><input type="number" step="0.01" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1"></div>'));
	tr.append($("<td>").append('<div class="input-group"><span class="input-group-addon" id="sizing-addon1">₱</span><input type="number" step="0.01" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1"></div>'));
	tr.append($("<td>").append('<input type="checkbox" class="has_variant" value="1" checked>'));

	return tr;
}

function build_variant_body(uniq_id){
	

	var div = $("<div>" , {role : "tabpanel"});

	var ul = $("<ul>" , {class : "nav nav-tabs" , role : "tablist"});
	ul.append($("<li>" , {role: "presentation" , class : "active"}).append('<a href="#'+uniq_id+'_inventory" aria-controls="'+uniq_id+'_inventory" role="tab" data-toggle="tab">Inventory</a>'));
	ul.append($("<li>" , {role: "presentation"}).append('<a href="#'+uniq_id+'_tax" aria-controls="'+uniq_id+'_tax" role="tab" data-toggle="tab">Tax</a>'));
	ul.append($("<li>" , {role: "presentation"}).append('<a href="#'+uniq_id+'_price" aria-controls="'+uniq_id+'_price" role="tab" data-toggle="tab">Price</a>'));

	var tab_content = $("<div>" , {class : "tab-content "});

	var tab_inventory = $("<div>" , {role : "tabpanel" , class : "tab-pane active no-padding" , id: uniq_id+"_inventory"});

	var table = $("<table>" , {class : "customer-table"});
	var tr = $("<tr>");
	
	tr.append($("<th>" , {text : "Outlet" , width : "40%"}));
	tr.append($("<th>" , {text : "Current Inventory	" , width : "20%"}));
	tr.append($("<th>" , {text : "Re-order Point" , width : "20%"}));
	tr.append($("<th>" , {text : "Re-order Quantity" , width : "20%"}));
	
	var thead = $("<thead>").append(tr);
	table.append(thead);

	table.append(build_outlet_list());
	tab_inventory.append(table);

	var tab_tax = $("<div>" , {role : "tabpanel" , class : "tab-pane no-padding" , id: uniq_id+"_tax"});
	var tab_price = $("<div>" , {role : "tabpanel" , class : "tab-pane no-padding" , id: uniq_id+"_price"});

	tab_content.append(tab_inventory);
	tab_content.append(tab_tax);
	tab_content.append(tab_price);

	div.append(ul);
	div.append(tab_content);

	var tr = $("<tr>" , {class : "variant-body customer-info  product-variant hidden _"+uniq_id});
	tr.append($("<td>"));
	tr.append($("<td>" , {colspan:"5"}).append(div));

	return tr;
}


function build_outlet_list(){
	var a = jQuery.parseJSON(outlet_list_json);
	var tbody = $("<tbody>");

	$.each( a , function(k , v){

		var tr = $("<tr>" , {class : "customer-row"});
		if(k == 0){
			tr.append('<td><span>'+v.outlet_name+'</span></td>');
			tr.append('<td><input type="number" class="form-control" value="0"><div class="text-right"><a href="javascript:void(0);" class="link-style apply-all" data-class=".current_inventory">Apply to all</a></div></td>');
			tr.append('<td><input type="number" class="form-control" value="0"><div class="text-right"><a href="javascript:void(0);" class="link-style apply-all" data-class=".reorder_point">Apply to all</a></div></td>');
			tr.append('<td><input type="number" class="form-control" value="0"><div class="text-right"><a href="javascript:void(0);" class="link-style apply-all" data-class=".reorder_amount">Apply to all</a></div></td>');
		}else{
			tr.append('<td><span>'+v.outlet_name+'</span></td>');
			tr.append('<td><input type="number" class="form-control current_inventory" value="0"></td>');
			tr.append('<td><input type="number" class="form-control reorder_point" value="0"></td>');
			tr.append('<td><input type="number" class="form-control reorder_amount" value="0"></td>');
		}

		tbody.append(tr);
	});

	return tbody;
}