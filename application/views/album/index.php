<container xmlns:ng="http://angularjs.org" ng-app="soClean">
    <div ng-controller="soCleanLandingPage">
        <div>
            <p>{{name}}</p>
            <img src="{{path}}"/>

        </div>
    </div>
</container>

<container data-ng-app="pics" xmlns:ng="http://angularjs.org" ng-app="myApp" data-ng-controller="PicsCtrl">
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
</container>

<container data-ng-app="pics" xmlns:ng="http://angularjs.org" ng-app="myApp" data-ng-controller="PicsCtrl">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div ng-controller="AlbumCtrl">
        <h2>Album</h2>
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
            </div>
            <div class="col-md-3">
              <div class="wrapper">
                <ul class="list">
                  <li ng-repeat="image in images | filter:categories" ng-click="setCurrentImage(image)">
                    <img ng-src="{{image.image}}" alt="{{image.description}}"/>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</container>
