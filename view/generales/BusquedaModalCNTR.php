<div class="modal fade" id="busqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registrar Venta</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" id="guardar_venta" name="guardar_venta">
					<!--<div id="resultados_ajax_productos"></div>-->
					<input type="hidden" id="codigoVenta" name="codigoVenta">
					<input type="hidden" id="codigoLiquidacion" name="codigoLiquidacion">
					<input type="hidden" id="codigoProducto" name="codigoProducto">




					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Fecha de Venta</label>
						<div class='col-sm-8'>
				                <div class='input-group date' id='fechaVenta'>
				                    <input type='text' class="form-control" id='fechaVenta' name='fechaVenta' placeholder="Fecha de Venta" readonly='true' required/>
				                    <span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
				                </div>

				        </div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Desde</label>
							<div class="col-sm-8">
							<div class='input-group date' id='fechaVigenciaDesde'>
								<input type="text" class="form-control" id="fechaVigenciaDesde" name="fechaVigenciaDesde" placeholder="Fecha de Vigencia Desde" readonly='true' required >
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
				                </span>
				                </div>
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Desde</label>
							<div class="col-sm-8">
							<div class='input-group date' id='fechaVigenciaHasta'>
								<input type="text" class="form-control" id="fechaVigenciaHasta" name="fechaVigenciaHasta" placeholder="Fecha de Vigencia Hasta" readonly='true' required >
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
				                </span>
				                </div>
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Hora</label>
							<div class="col-sm-8">
							<div class='input-group date' id='hora'>
								<input type="text" class="form-control" id="hora" name="hora" placeholder="Hora" required maxlength="10">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
				                </span>
				                </div>
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Vehiculo</label>
						<div class="col-sm-8">
							<div class='input-group search'>
								<input type="text" class="form-control" id="vehiculo" name="vehiculo" placeholder="Vehiculo" maxlength="7" required>
								<span class="input-group-addon">
									<a href="#" onClick="abrirBusquedaPuntoVenta();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
				            	</span>
				            	<input class="form-control" name="codigoVehiculo" id="codigoVehiculo" type="hidden" value="">
							</div>
						</div>

					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Comprobante</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Comprobante" required maxlength="50">
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Comision</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="comision" name="comision" placeholder="Comision" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar</button>
				</div>


			</form>
		</div>
	</div>
</div>