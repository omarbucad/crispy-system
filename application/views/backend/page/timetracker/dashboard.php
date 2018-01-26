<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="panel panel-default">

            <div class="panel-heading"  style="overflow: hidden;">
                <div class="col-lg-10">
                    <strong style="line-height: 35px;">HI MHAR TODAY'S SCHEDULE FOR ABC COMPANY</strong>
                </div>
                <div class="col-lg-2">
                   <div class="input-group">
                        <select class="form-control" id="select_locations">
                            <?php foreach($outlet_list as $row) : ?>
                                <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-success" style="margin: 0px !important;" type="button"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">STAFF</th>
                        <th style="width: calc(90% / 24);" class="text-center">6A</th>
                        <th style="width: calc(90% / 24);" class="text-center">7A</th>
                        <th style="width: calc(90% / 24);" class="text-center">8A</th>
                        <th style="width: calc(90% / 24);" class="text-center">9A</th>
                        <th style="width: calc(90% / 24);" class="text-center">10A</th>
                        <th style="width: calc(90% / 24);" class="text-center">11A</th>
                        <th style="width: calc(90% / 24);" class="text-center">12p</th>
                        <th style="width: calc(90% / 24);" class="text-center">1P</th>
                        <th style="width: calc(90% / 24);" class="text-center">2P</th>
                        <th style="width: calc(90% / 24);" class="text-center">3P</th>
                        <th style="width: calc(90% / 24);" class="text-center">4P</th>
                        <th style="width: calc(90% / 24);" class="text-center">5P</th>
                        <th style="width: calc(90% / 24);" class="text-center">6P</th>
                        <th style="width: calc(90% / 24);" class="text-center">7P</th>
                        <th style="width: calc(90% / 24);" class="text-center">8P</th>
                        <th style="width: calc(90% / 24);" class="text-center">9P</th>
                        <th style="width: calc(90% / 24);" class="text-center">10P</th>
                        <th style="width: calc(90% / 24);" class="text-center">11P</th>
                        <th style="width: calc(90% / 24);" class="text-center">12A</th>
                        <th style="width: calc(90% / 24);" class="text-center">1A</th>
                        <th style="width: calc(90% / 24);" class="text-center">2A</th>
                        <th style="width: calc(90% / 24);" class="text-center">3A</th>
                        <th style="width: calc(90% / 24);" class="text-center">4A</th>
                        <th style="width: calc(90% / 24);" class="text-center">5A</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MHAR BUCAD</td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</div>