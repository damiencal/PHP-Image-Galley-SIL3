<container ng-app="myApp">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div ng-controller="AlbumCtrl">
        <img src="//www.nganimate.org/img/angular-logo.png" alt="AngularJS Logo" class="angLogo"/>
        <h2>AngularJS Powered Photo Album <small>by Josh Adamous</small> </h2>
          <div class="row">
            <div class="col-md-9">
              <div class="albumImage">
                <img ng-src="{{currentImage.image}}" alt="{{currentImage.description}}"/>
              </div>
              <h3>{{currentImage.description}}</h3>
              <p class="badge"><span class="glyphicon glyphicon-star"></span>{{currentImage.stars}}</p>
              <select ng-model="categories"
                      ng-options="category for category in imageCategories">
                <option value="">All</option>
              </select>
              <label for="select">Select a Rating:</label>
            </div><!-- End of Column -->
            <div class="col-md-3">
              <div class="wrapper">
                <ul class="list">
                  <li ng-repeat="image in images | filter:categories" ng-click="setCurrentImage(image)">
                    <img ng-src="{{image.image}}" alt="{{image.description}}"/>
                  </li>
                </ul><!-- End of List -->
              </div><!-- End of Wrapper -->
            </div><!-- End of Column -->
          </div><!-- End of Row -->
        </div><!-- End of Album Controller -->
      </div><!-- End of Column -->
    </div><!-- End of Row -->
  </div><!-- End of Container -->
</container><!-- End of Body -->

<script>
angular.module('myApp', [])
.controller('AlbumCtrl', function($scope) {
  $scope.images = [
    {category : 'High', image : 'http://lorempixel.com/g/850/400', description : 'Random Photo', stars : '4/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/sports', description : 'Sports Photo', stars : '3/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/animals', description : 'Animal Photo', stars : '3/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/abstract', description : 'Abstract Photo', stars : '5/5'},
    {category : 'Low', image : 'http://lorempixel.com/g/850/400/business', description : 'Business Photo', stars : '1/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/cats', description : 'Cat Photo', stars : '4/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/city', description : 'City Photo', stars : '3/5'},
    {category : 'Low', image : 'http://lorempixel.com/g/850/400/fashion', description : 'Fashion Photo', stars : '2/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/nature', description : 'Nature Photo', stars : '5/5'}
  ];

  $scope.currentImage = _.first($scope.images);

  $scope.imageCategories = _.uniq(_.pluck($scope.images, 'category'));

  $scope.setCurrentImage = function(image) {
    $scope.currentImage = image;
  };
});
</script>






 <body data-ng-controller="PicsCtrl">

    <h3>Albums</h3>
    <div id="albums">
      <ul>
        <li data-ng-repeat="album in albums" data-ng-class="{'selected': album.id == selectedAlbum.id}">
          <span>
            <span data-ng-click="selectAlbum(album)">{{album.name}}</span>
            <span data-ng-click="deleteAlbum(album)">[x]</span>
          </span>
        </li>
      </ul>
    </div>
    <p>
      Stash width :
      <input type="text" name="stashWidth" id="stashWidth" data-ng-model="stashWidth" /> px
      | Scale :
      <input type="number" name="scale" id="scale" min="10" step="10" max="300" data-ng-model="scale" />
      % | Reechantillonating page size
      <input type="number" name="scale" id="scale" min="10" step="10" max="1000" data-ng-model="reechantillonatingPageSize" />
      |
      <button type="button" class="btn btn-large btn-danger" data-ng-click="reechantillonateStash($event)">
        <i class="icon-time"></i><span> Reechantillonate</span>
      </button>
    </p>

    <h3>
      Pictures Stash ({{stash.size}}) ({{selectedPictures.length}})
      <button type="button" class="btn btn-large btn-primary"  data-ng-click="addRandomPicture()" data-ng-mousedown="startAddRandomPicture()" data-ng-mouseup="stopAddRandomPicture()">
        Add random picture
      </button>
    </h3>
    <h3>Stash keeping flux</h3>
    <div id="stash">
      <div>
        <div class="stashPicture" data-ng-repeat="picture in stash.pictures"
            data-ng-class="{'selected' : picture.selected, 'removed' : picture.removed,
            'overlayed' : picture.overlayed,
            'rotatingLeft' : picture.rotatingLeft,'rotatingRight' : picture.rotatingRight}"
            data-ng-click="selectPicture($event, picture)"
            style="height: {{picture.height}}px; width: {{picture.width}}px">
          <div class="stashThumbnail" style="
              height: {{picture.height * hoverZoom}}px;
              width: {{picture.width * hoverZoom}}px;
              margin-left: {{-(hoverZoom - 1) * picture.width / 2}}px;
              margin-top: {{-(hoverZoom - 1) * picture.height / 2}}px;
              font-size: {{scale/100}}em;">

            <img src="http://lorempixel.com/{{picture.thumbnailWidth}}/{{picture.thumbnailHeight}}"
                class="img-rounded" />

            <div class="overlay" data-ng-click="$event.stopPropagation();">
              <p>{{picture.waitingMsg}}</p>
              <i class="icon-spin icon-spinner icon-large"></i>
              <button type="button" class="btn btn-large btn-primary btn-action" data-ng-click="overlayAction($event, picture)">
                <i class="icon-action"></i>
              </button>
            </div>

            <div class="title" data-ng-click="$event.stopPropagation();">

            </div>

            <div class="buttonBar" data-ng-click="$event.stopPropagation();">
              <span class="btn-group">
                <button type="button" class="icon newShoot btn btn-mini btn-info" title="new shoot"
                    >
                  <i class="icon-camera icon-large"></i>
                </button>
                <button type="button" class="icon newSession btn btn-mini btn-primary" title="new session">
                  <i class="icon-folder-open icon-large"></i>
                </button>
              </span>
              <span class="btn-group" data-ng-style="font-size: {{scale/100}}em">
                <button type="button" class="icon rotateLeft btn btn-mini btn-warning" title="rotate left"
                    data-ng-click="rotatePictureLeft($event, picture)">
                  <i class="icon-rotate-left icon-large"></i>
                </button>
                <button type="button" class="icon rotateRight btn btn-mini btn-warning" title="rotate right"
                    data-ng-click="rotatePictureRight($event, picture)">
                  <i class="icon-rotate-right icon-large"></i>
                </button>
              </span>
              <span class="btn-group" data-ng-style="font-size: {{scale/100}}em">
                <button type="button" class="icon tags btn btn-mini btn-success" title="add tags">
                  <i class="icon-tags icon-large"></i>
                </button>
              </span>
              <span class="btn-group" data-ng-style="font-size: {{scale/100}}em">
                <button type="button" class="icon remove btn btn-mini btn-danger" title="remove"
                    data-ng-click="removePicture($event, picture)">
                  <i class="icon-remove-sign icon-large"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </body>








<script>
var app = angular.module('pics', []);
app.controller('PicsCtrl', function($scope, $timeout) {
  $scope.albums = [
      {name : 'Album 1', id : '1', pictures : [
        { id : '1', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x150', image : 'http://placehold.it/350x150'},
        { id : '2', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x150', image : 'http://placehold.it/350x150'},
        { id : '3', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x150', image : 'http://placehold.it/350x150'}]},
      {name : 'Album 2', id : '2', pictures : [
        { id : '4', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x50', image : 'http://placehold.it/350x150'},
        { id : '5', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x50', image : 'http://placehold.it/350x150'},
        { id : '6', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x50', image : 'http://placehold.it/350x150'}]},
      {name : 'Album 3', id : '3', pictures : [
        { id : '7', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x250', image : 'http://placehold.it/350x150'},
        { id : '8', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x250', image : 'http://placehold.it/350x150'},
        { id : '9', thumbnailWidth: 150, thumbnailHeight: 100, thumbnail : 'http://placehold.it/150x250', image : 'http://placehold.it/350x150'}]},
    ];
  $scope.stashWidth = getBodyWidth();
  $scope.scale = 100;
  $scope.selectedPictures = [];
  $scope.stashRows = [];
  $scope.stashRowsToReechantillonate = [];
  $scope.hoverZoom = 1;
  $scope.reechantillonatingPageSize = 200;

  $scope.selectAlbum = function (album) {
    $scope.selectedAlbum = album;
    var width = $scope.stashWidth;
    console.log(width);
        $scope.stash = buildNewStash(width, $scope.scale);
    angular.forEach(album.pictures, function(value, key){
      $scope.stash.addPicture(value);
    });
  };
  $scope.reechantillonateStash = function(event) {
    var pageSize = $scope.reechantillonatingPageSize;
    $scope.stash.reechantillonate($scope.stashWidth, $scope.scale, pageSize, $timeout);
  };

  $scope.addRandomPicture = function(number) {
    if (!number || number < 1) {
      number = 1;
    }

    for (var k = 0; k < number; k++) {
      var newPic = {};
      var width = Math.floor(Math.random() * 600) + 100; // 50 - 450
      //var height = Math.floor(Math.random() * 100) + 50; // 50 - 150
      var height = 200;

      newPic.thumbnail = 'http://placehold.it/' + width + 'x' + height;
      newPic.image = 'http://placehold.it/' + width + 'x' + height;
      newPic.thumbnailWidth = width;
      newPic.thumbnailHeight = height;

      $scope.stash.addPicture(newPic);
    }
  };
  $scope.startAddRandomPicture = function() {
    $scope.autoAdding = setTimeout(function() {
      $scope.startAddRandomPicture();
      $scope.addRandomPicture();
    }, 10);
  };
  $scope.stopAddRandomPicture = function() {
    clearInterval($scope.autoAdding);
  };

  $scope.deleteAlbum = function(album) {
    var confirm = window.confirm("Are you sure you want to delete album: " + album.name + " ?");
    if (confirm) {
      var index = $scope.albums.indexOf(album)
      $scope.albums.splice(index, 1);
    }

    if ($scope.selectedAlbum == album) {
      $scope.selectedAlbum = null;
    }

  };
  $scope.selectPicture = function($event, picture) {
    console.log('toggle selection on picture');
    picture.selected = !picture.selected;
    picture.overlayed = picture.selected;

    var array = $scope.selectedPictures;
    if (picture.selected) {
      array.push(picture);
      //picture.zoom = 1;
    } else {
      array.splice(array.indexOf(picture), 1);
      //picture.zoom = 1;
    }
  };
  $scope.rotatePictureLeft = function($event, picture) {
    picture.waitingMsg = 'Rotating to the left...';
    picture.rotatingLeft = true;
    picture.overlayed = true;
  };

  $scope.rotatePictureRight = function($event, picture) {
    picture.waitingMsg = 'Rotating to the right...';
    picture.rotatingRight = true;
    picture.overlayed = true;
  };

  $scope.removePicture = function($event, picture) {
    picture.removed = !picture.removed;
    picture.overlayed = picture.removed;
  };

  $scope.overlayAction = function($event, picture) {
    if (picture.overlayed) {
      if (picture.selected) {
        $scope.selectPicture($event, picture);
      } else if (picture.removed) {
        $scope.removePicture($event, picture);
      }
    }
  };

  $scope.selectAlbum($scope.albums[1]);
  $scope.addRandomPicture(50);
});
function getBodyWidth() {
  return document.getElementsByTagName('body')[0].offsetWidth;
}
function buildNewStash(width, scale) {
  var stash = {
    pictures : [],
    size: 0,
    rows : [],
    scale : (scale) ? scale / 100 : 1,
    width : (width) ? width : 600,
    margin : 1,
    getLastRow : function() {
      if (this.rows.length < 1) {
        this.addNewRow();
      }
      return this.rows[this.rows.length -1];
    },
    addNewRow : function() {
      var parentStash = this;
      var newRow = {
        pictures : [],
        height : 0,
        width : 0,
        addPicture : function(picture) {
          var nbPic = this.pictures.length || 0;
          var hypotheticWidth = nbPic * parentStash.margin + this.width + picture.width;
          if (hypotheticWidth > parentStash.width) {
            return false;
          }

          this.pictures.push(picture);
          this.height = Math.max(this.height, picture.height);
          this.width += picture.width;

          return true;
        },
        finalizeRow : function() {
          var ratio = (parentStash.width - 1 - parentStash.margin * this.pictures.length) / this.width;
          this.height = Math.round(this.height * ratio);

          var offset = 0;
          angular.forEach(this.pictures, function(value, key) {
            // Enlarge thumbnails of row to occupy all the width
            var exactWidth = value.width * ratio + offset;
            var roundedWidth = Math.round(exactWidth);

            // offset due to rounding
            offset = exactWidth - roundedWidth;

            value.width = roundedWidth;
            value.height = this.height;
          }, this);
        }
      };
      this.rows.push(newRow);
      console.log('Added new row: #' + (this.rows.length - 1));

      return newRow;
    },
    addPicture : function(picture) {
      picture.selected = false;
      picture.zoom = 1;
      this.pictures.push(picture);

      this._addPictureInternal(picture);
    },
    _addPictureInternal : function(picture) {
      // Rescale
      picture.width = Math.round(picture.thumbnailWidth * this.scale);
      picture.height = Math.round(picture.thumbnailHeight * this.scale);

      var lastRow = this.getLastRow();
      var enoughSpace = lastRow.addPicture(picture);
      if (!enoughSpace) {
        // Not enough space in row for the picture
        lastRow.finalizeRow();

        var newRow = this.addNewRow();
        newRow.addPicture(picture);
      }
      this.size ++;
    },
    reechantillonate : function(width, scale, pageSize, $timeout) {
      // Stop current job
      if (this.job) {
        $timeout.cancel(this.job)
      }

      // Update stash configuration
      this.scale = (scale) ? scale / 100 : 1;
      this.width = (width) ? width : 600;
      this.size = 0;
      // Purge rows
      this.rows.length = 0;

      // Launch reechantonation process
      this._reechantillonatePageInternal(0, pageSize, $timeout);
    },
    _reechantillonatePageInternal : function(page, pageSize, $timeout) {
      for (var k = page * pageSize; k < (page + 1) * pageSize; k++) {
        if (k < this.pictures.length) {
          this._addPictureInternal(this.pictures[k]);
        }
      }
      var parentStash = this;
      if ((page + 1) * pageSize < this.pictures.length) {
        parentStash.job = $timeout(function() {
          parentStash._reechantillonatePageInternal(page + 1, pageSize, $timeout);
        }, 500);
      }
    }
  };

  return stash;
}

</script>
