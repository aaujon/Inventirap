$(document).ready(function() {
	//Page index de matériel
	$('#t_informations').click(function() {
		$('#informations').toggle('fast');
		toogleChevron('#i_informations');
	});
	$('#t_suivis').click(function() {
		$('#suivis').toggle('fast');
		toogleChevron('#i_suivis');
	});
	$('#t_emprunts').click(function() {
		$('#emprunts').toggle('fast');
		toogleChevron('#i_emprunts');
	});
	
	//Page find de matériel
	$('#t_filter').click(function() {
		$('#filter').toggle('fast');
		toogleChevron('#i_filter');
	});
	$('#t_result').click(function() {
		$('#result').toggle('fast');
		toogleChevron('#i_result');
	});
});

function toogleChevron(element) {
	if ($(element).hasClass('icon-chevron-down')) {
			$(element).removeClass('icon-chevron-down');
			$(element).addClass('icon-chevron-up');
	}
	else {
		$(element).removeClass('icon-chevron-up');
		$(element).addClass('icon-chevron-down');
	}
}

function emprunt_interne_externe() {
	$('#interne').toggle();
	$('#externe').toggle();		
}

function selectAll() {
	for(i = 0; i < document.getElementsByTagName("input").length; i++)
		document.getElementsByTagName("input")[i].checked = true;
}
function selectNone() {
	for(i = 0; i < document.getElementsByTagName("input").length; i++)
		document.getElementsByTagName("input")[i].checked = false;
}