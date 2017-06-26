//<?php echo $model->getClassNote(),"\n";?>
const <?php echo strtoupper($model->getTableModel()->getName());?>_GET_FAILED = <?php echo($model->getProjectErrorNum()+201);?>;
const <?php echo strtoupper($model->getTableModel()->getName());?>_REMOVE_FAILED = <?php echo($model->getProjectErrorNum()+202);?>;
const <?php echo strtoupper($model->getTableModel()->getName());?>_SAVE_FAILED=<?php echo($model->getProjectErrorNum()+203);?>;
