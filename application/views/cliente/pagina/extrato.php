<h2 class="text-muted"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Extrato</h2><p>Últimos 90 dias</p>
<div class="panel panel-default">
     <table class="table">
         <thead>
            <tr>
                <th>Recibo</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Crédito</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($extratos)): ?>
                <?php $subTotal = 0; ?>
                <?php foreach($extratos as $extrato): ?>
                <tr class="<?php if(!$extrato["status"] && $extrato["id_fatura"]) : ?>bg-danger text-danger<?php endif; ?> <?php echo $extrato["sum_extrato"] < 0 ? "danger text-danger" : "";?>">
                    <td>
                       <?php if (!$extrato["status"] && $extrato["id_fatura"]) : ?>
                            <p class="fs-11 l-through-no">Cancelado por <br/><b><?php echo $extrato["nome_cancelamento"];?></b><br/>em <?php echo date("d/m/Y", strtotime($extrato["data_cancelamento"])); ?></p>
                        <?php else: ?>
                           R<?php echo str_pad($extrato["id_fatura"], 5, 0,  STR_PAD_LEFT); ?>
                        <?php endif; ?>
                    </td>
                    <td><em> R$ <?php echo number_format($extrato["vlr_pago"], 2, ",", "."); ?></em></td>
                    <td><?php echo date("d/m/Y", strtotime($extrato["dt_pagamento"])); ?></td>
                    <td>
                    	<?php echo $extrato["desc_pagamento"]; ?>
                    	<?php if ($extrato["usuario_operador"]): ?>
                            <br/>Compra efutado(a) por: <?php echo $extrato["usuario_operador"]; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $extrato["nome_tipo"]; ?></td>
                    <td><em> R$ <?php echo number_format($extrato["sum_extrato"], 2, ",", "."); ?></em></td>
                </tr>
                <?php $subTotal = $extrato["id_tipo_entrada_caixa"] ? $extrato["sum_extrato"] : $subTotal ;?>
                <?php endforeach; ?>
             <?php else: ?>
                 <tr colspan="6">
                     <td><span>Nenhum registro encontrado.</span></td>
                 </tr>
             <?php endif; ?>
         </tbody>
         <?php if (!empty($extratos)): ?>
             <tfoot>
                 <tr>
                     <?php $creditoHas = 0; ?>
                     <?php foreach ($sumCredito as $tot): ?>
                            <?php if ($tot["id_tipo_pagamento"] == 2): ?>
                                <?php $creditoHas = $tot["total"]; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                     <td colspan="5" class="<?php echo $creditoHas < 0 ? "text-danger" : "";?>">
                         <strong>Total Crédito: </strong><em>R$ <?php  echo number_format($creditoHas, 2, ",", "."); ?></em>
                         
                     </td>
                     <td class="<?php echo $subTotal < 0 ? "text-danger" : "";?>">
                         <strong>Sub total:<br/></strong> <em> R$ <?php  echo number_format($subTotal, 2, ",", "."); ?></em>
                     </td>
                 </tr>
             </tfoot>
         <?php endif; ?>
    </table>
</div>