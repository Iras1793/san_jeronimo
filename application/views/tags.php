<?php foreach ($estilos as $key => $css): ?>
  <link rel="stylesheet" href="<?php echo base_url($css) ?>">
<?php endforeach ?>


<div class="wrapper d-flex flex-column min-vh-100">

	<?php echo $menu_superior; ?>

<!-- Comienza contenido -->
<div class="body flex-grow-1">
	<div class="container-lg px-4">

<div class="card mb-4">
            <div class="card-header">
              <strong>Registro de tags</strong>
            </div>
            <div class="card-body">
              <p class="text-body-secondary small">Información obtenida desde el excel</p>              
              <div class="d-flex justify-content-end">
              <a href="<?php echo site_url('tags/agregar') ?>" class="btn btn-success text-white">
<svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" class="icon" viewBox="0 0 16 16">
  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
</svg>                
                Nuevo
              </a>                
              </div>



              <div class="example">
                <ul class="nav nav-underline-border" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-coreui-toggle="tab" href="#preview-1001" role="tab" aria-selected="true">
                      <svg fill="currentColor" class="icon me-2" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                      </svg>
                      Información básica
                    </a>
                  </li>
                  
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" data-coreui-toggle="tab" href="#preview-1002" role="tab" aria-selected="true">
                      <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="var(--ci-primary-color, currentcolor)" d="m388.632 393.82 107.191-137.88-107.139-137.762-25.26 19.644 91.864 118.122-91.92 118.236zm-240.053-19.639L56.712 255.999l91.917-118.176-25.258-19.646L16.177 255.993l107.137 137.826zM330.529 16h-32.97L178.441 496h32.971z" class="ci-primary"></path>
                      </svg>
                      Detalles
                    </a>
                  </li>
                  
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1001">
                    <table class="table table-bordered table-hover" id='viviendas_table'>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Número de serie</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Asignado a</th>
                          <th scope="col">Fecha de asignación</th>
                          <th scope="col">Fecha de activación</th>
                          <th scope="col">Activado</th>
                          <th scope="col" id="noExport">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="table-info">
                          <th scope="row">1</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>
<ul class="list-group list-group-horizontal">
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-warning" href="#">
<svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
                              <span class="text-white">
                                Editar
                              </span>
                            </a>
</li>
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-danger" href="#" data-coreui-toggle="modal" data-coreui-target="#modalEliminar">
<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg>                            
                            <span class="text-white">
                              Eliminar
                            </span>
                          </a>    
  </li>
</ul>                            

                            
                          </td>
                        </tr>
                        <tr class="table-info">
                          <th scope="row">2</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>
<ul class="list-group list-group-horizontal">
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-warning" href="#">
<svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
                              <span class="text-white">
                                Editar
                              </span>
                            </a>
</li>
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-danger" href="#" data-coreui-toggle="modal" data-coreui-target="#modalEliminar">
<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg>                            
                            <span class="text-white">
                              Eliminar
                            </span>
                          </a>    
  </li>
</ul>                            

                            
                          </td>                          
                        </tr>
                        <tr class="table-info">
                          <th scope="row">3</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Prueba</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>
<ul class="list-group list-group-horizontal">
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-warning" href="#">
<svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
                              <span class="text-white">
                                Editar
                              </span>
                            </a>
</li>
  <li class="list-group-item" style="border: none !important;background-color: transparent!important;">
                            <a class="btn btn-danger" href="#" data-coreui-toggle="modal" data-coreui-target="#modalEliminar">
<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon" viewBox="0 0 16 16" style="fill:#FFF!important">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg>                            
                            <span class="text-white">
                              Eliminar
                            </span>
                          </a>    
  </li>
</ul>                            

                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3" role="tabpanel" id="preview-1002">
                    <h1>mamadas</h1>
                  </div>
                </div>

              </div>
            </div>
          </div>


	</div>
</div>
<!-- Fin contenido -->


<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminar" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminar">¿Seguro que deseas eliminar el registro?</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ffd64f" class="" viewBox="0 0 16 16" width="76" height="76" >
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                </center>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info text-white" type="button" data-coreui-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger text-white" type="button">Sí, eliminar</button>
            </div>
        </div>
    </div>
</div>  


<?php echo $footer; ?>

<?php foreach ($javascript as $key => $js): ?>
  <script src="<?php echo base_url($js) ?>"></script>
<?php endforeach ?>


<script>



new DataTable('#viviendas_table', {
    language: {
        url: '<?php echo base_url("assets/js/datatable_lang_es.json") ?>',
    },  
    scrollX: true,
    scrollY: 400,
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Excel',
            className: 'btn-success text-white mr-4',
            exportOptions: {columns: ':not(:last-child)',}
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            className: 'btn-danger text-white',
            exportOptions: {columns: ':not(:last-child)'}
        }
    ]
});



</script>

</div>