<style type="text/css">
    #attendance_side_menu section:not(:last-child){
        margin: 2px;
        border-bottom: 1px solid rgba(0,0,0,0.2);
    }
    #attendance_side_menu section.s_header , #attendance_side_menu section.ac-btn-group{
        overflow: hidden;
    }
    #attendance_side_menu section.s_header > * {
        float: left;
    }
    #attendance_side_menu section.s_header > span{
        width: 80%;
        font-weight: bold;
        padding: 10px;
    }
    #attendance_side_menu section.s_header > button{
        width: 20%;
        display: block;
        height: 38px;
        border-color: transparent;
        background-color: transparent;
        border-left-color: rgba(0,0,0,0.2);
        border-width: 0.01em;
    }
    #attendance_side_menu section.ac-btn-group > button{
        float: left;
        width: 50% !important;
        border:none;
        background: transparent;
        font-weight: bold;
        padding: 10px;
    }
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-2" id="attendance_side_menu">
                <div class="card">
                    <section class="s_header">
                        <span>Pay Periods</span>
                        <button><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </section>
                    <section>
                        <select class="form-control">
                            <option>January 1 - 15 2018</option>
                        </select>
                    </section>
                    <section class="ac-btn-group">
                        <button >EDIT</button>
                        <button >CLOSE OUT</button>
                    </section>
                </div>
            </div>
            <div class="col-lg-10">1</div>
        </div>
    </div>
</div>