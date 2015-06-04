<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <style type="text/css">
    body {
        padding: 20px;
    }
    h4 {
        padding: 10px;
        background: white;
    }
    .checkbox label {
        display: block;
    }
    form {
        margin-bottom: 20px;
    }
    img {
        margin-top: 20px;
        width: 200px;
    }
    .item-entry {
      padding: 10px;
      background: #EDEDED;
      display: table;
      width: 100%;
    }
    .item-entry + a {
      float: right;
      margin-top: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container-fluid">

      <div class="row">
      
      <div class="col-sm-6">
        <h4>way form</h4>
        <form id="myform" role="form" class="form-horizontal" way-data="formData" way-persistent="true">
          <div class="form-group">
            <label class="col-sm-3">Name</label>
            <div class="col-sm-9">
              <input id="nemo" type="text" class="form-control" name="name" placeholder="Name" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3">Picture</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="picture" placeholder="Enter an image's URL" autocomplete="off">
              <img class="img-responsive" way-data="formData.picture" way-default="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3">Nationality</label>
            <div class="col-sm-9 checkbox">
              <label>
                <input type="checkbox" name="nationality[]" value="french">French<br/>
              </label>
              <label>
                <input type="checkbox" name="nationality[]" value="american">American<br/>
              </label>
              <label>
                <input type="checkbox" name="nationality[]" value="british">British<br/>
              </label>
              <label>
                <input type="checkbox" name="nationality[]" value="chinese">Chinese<br/>
              </label>
            </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3">Skills</label>
              <div class="col-sm-9">
                <a href="#" way-action-push="formData.skills">Add a skill</a>
              </div>
          </div>
          
          <div id="wrapper" way-repeat-wrapper="0" way-scope="formData.skills">        
            <div class="form-group rep skillwrapper" data-index="$$key" way-repeat="formData.skills" style="padding: 0px;">
                <label class="col-sm-3"></label>
                <div class="col-sm-9">
                  <div class="item-entry">
                    <span class="btn btn-sm btn-info btn_drag">Drag</span>
                    <input type="text" class="form-control" placeholder="Enter a skill" way-data="title" way-persistent="true">
                    <input type="text" class="form-control" placeholder="Enter a hobby" way-data="hobby" way-persistent="true">
                  </div>
                  <a href="#" way-action-remove="formData.skills.$$key" way-persistent="true">Remove</a>

                </div>

            </div>
          </div>
        
        </form>
      </div>

      <div class="col-sm-6">
        <div id="div1">This should turn red on name="hidden"</div>
        <h4>way data</h4>
        <pre way-data="__all__" way-json="true" way-default="{}"></pre>
        <button class="btn btn-danger" way-clear way-persistent="true">Clear data</button>

        <button ic-get-from="/contact/1/edit" class="btn btn-default">
          Intercooler
        </button>

        <div id="foo"></div>
      </div>

      <script type="text/javascript" src="/dist/pfgs_way_demo.min.js"></script>

      <script>
      jQuery(document).ready(function($){
        var el = $('#wrapper').get(0)
        var sortable = Sortable.create(el,{
          handle: '.btn_drag',
          onUpdate: function (evt) {
              var els = document.getElementsByClassName("skillwrapper");
              var replace = [];
              for(var i = 0; i < els.length; i++)
              {
                 var old_index = els.item(i).dataset.index;
                 replace.push( way.get('formData.skills.' + old_index) );
              }
              way.set('formData.skills',replace);
              way.backup();
          },
        });

        //TODO manually fire this on reload
        way.watch('formData.name',function(name_val){
          if ( name_val == 'hidden' ){
            var d = document.getElementById("div1");
            d.className = d.className + " text-danger";
          }
        });
      });

      var hoop = ['one','two'];
        _.each(hoop,function(h){
          console.log(h);
        });

      </script>
</body>
</html>
