<?php
    require_once('connection.php');
    class Orders extends Connection{
        public function fetch($condition,$start,$limit){
            $query = $this->select("o.*,u.user_email,i.invoice_total,i.invoice_transac","obs_usersorder as o inner join obs_users as u on o.user_id=u.user_id
                                inner join obs_invoice as i on o.invoice_id=i.invoice_id","".$condition." and i.invoice_status=1","o.order_id desc limit ".$start.",".$limit."");
            if ($query->num_rows > 0){
                return $query;
            }else{
                return false;
            }
        }
        public function fetchdetail($id){
            $query = $this->select("o.*,u.user_email,i.invoice_total,id.invd_price,id.invd_discount,id.invd_amount,b.book_title,b.book_thumbnail"
                                ,"obs_usersorder as o inner join obs_users as u on o.user_id=u.user_id
                                inner join obs_invoice as i on o.invoice_id=i.invoice_id
                                inner join obs_invoice_detail as id on i.invoice_id=id.invoice_id
                                inner join obs_books as b on id.book_id=b.book_id","o.invoice_id=".$id." and i.invoice_status=1",1);
            if ($query->num_rows > 0){
                while ($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                ?>
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-6 card"><div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <span><strong>Email:</strong> <?php echo $data[0]['user_email'];?></span>
                            </div>
                            <div class="col">
                                <span><strong>Order date:</strong> <?php echo $data[0]['order_date'];?></span>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <span><strong>Invoice No:</strong> <?php echo $id;?></span>
                            </div>
                            <div class="col">
                                <span><strong>Total Amount:</strong> $<?php echo number_format($data[0]['invoice_total'],2);?></span>
                            </div>
                        </div></div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-6 card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th colspan="2">BooK</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    for ($i=0;$i<count($data);$i++){
                                    ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td colspan="2"><img src="uploads/thumbnail/<?php echo $data[$i]['book_thumbnail'];?>" width="100px" height="auto" /><?php echo $data[$i]['book_title']; ?></td>
                                        <td><?php echo "$".number_format($data[$i]['invd_price'],2); ?></td>
                                        <td><?php echo $data[$i]['invd_discount']==null? 0: $data[$i]['invd_discount']; ?></td>
                                        <td><?php echo "$".number_format($data[$i]['invd_amount'],2); ?></td>
                                    </tr>
                                <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                
                
            }else{
                return false;
            }
        }
    }
?>