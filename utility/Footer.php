<?php
function paginacion($pagina,$totalPaginas){
	$htmlFooter ="";

	$htmlFooter .= '<ul class="pagination pagination-large">';

	if ($pagina==1){
		$htmlFooter .= '<li class="disabled"><span><a>&lsaquo; Prev</a></span></li>';
	}else if ($pagina>1){
		$htmlFooter .= '<li><span><a href="javascript:void(0);" onclick="javascript:direccion(\'-1\');">&lsaquo; Prev</a></span></li>';
	}

	if($pagina>1) {
		$htmlFooter .= '<li><a href="javascript:void(0);" onclick="javascript:void(0);">1</a></li>';
	}

	if ($pagina>2){
		$htmlFooter.= "<li><a>...</a></li>";
	}

	if($totalPaginas>=1 && $pagina<$totalPaginas) {
		$htmlFooter .= '<li><a href="javascript:void(0);" onclick="javascript:void(0);">'.$pagina.'</a></li>';
	}

	if($totalPaginas>=3 && ($totalPaginas-$pagina)>1) {
		$htmlFooter.= "<li><a>...</a></li>";
	}

	if($pagina>=1) {
		$htmlFooter.= '<li><a href="javascript:void(0);" onclick="javascript:void(0);">'.$totalPaginas.'</a></li>';
	}

	if($pagina<$totalPaginas) {
		$htmlFooter.= '<li><span><a href="javascript:void(0);" onclick="javascript:direccion(\'1\');">Next &rsaquo;</a></span></li>';
	}else{
		$htmlFooter.= '<li class="disabled"><span><a>Next &rsaquo;</a></span></li>';
	}

	$htmlFooter.= '</ul>';

	return $htmlFooter;
}
?>