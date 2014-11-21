    <script>document.write('<base href="' + document.location + '" />');</script>
<style>
    #albums ul {
  white-space: nowrap;
  margin: 0px;
}
#albums li {
  display: inline;
  list-style-type: none;
  padding-left: 2px;
  padding-right: 2px;
}
#albums span[data-ng-click] {
  cursor: pointer;
  color: blue;
}
#albums span[data-ng-click]:HOVER {
  text-decoration: underline;
}
#albums .selected span {
  color: red;
}
.button {
  cursor: pointer;
  text-decoration: none;
  border: 1px solid blue;
  background-color: lightblue;
  padding: 5px;
  user-select: none;
}
.button:HOVER {
  text-decoration: none;
  background-color: lightgray;
  border: 1px solid gray;
}
#stash {
  width: 100%;
  font-size: 0.8em;
}
.stashRow {
}
.stashPicture {
  position: relative;
  float: left;
  margin-left: 1px;
  margin-bottom: 1px;
  z-index: 1;
}
.stashPicture:HOVER {
}
.stashPicture.selected {
}
.stashThumbnail {
  position: relative;
  cursor: pointer;
  z-index: 1;
}
.stashThumbnail:HOVER {
  background-color: transparent;
}
.stashThumbnail img {
  position: relative;
  z-index: 10;
  width: 100%;
  height: 100%;
}
.stashThumbnail .btn {
  font-size: 1em;
  margin-bottom: 0.5em;
  padding: 0.4em 0.8em;
}
.stashPicture:not(.selected) .stashThumbnail:HOVER img {
  /*
  width: 120%;
  height: 120%;
  top: -10%;
  left: -10%;
  */
  /*opacity: 0.8;*/
  background-color: transparent;
}
.selected .stashThumbnail {
  background-color: #E3FEC8;
  border: 3px solid #51a351;
  color : #51a351;
}
.selected .stashThumbnail img, .removed .stashThumbnail img,
.overlayed .stashThumbnail img {
  opacity: 1;
}
.removed .stashThumbnail {
  background-color: orange;
  border: 3px solid red;
  color: red;
}
.stashThumbnail .overlay {
  cursor: default;
  position: absolute;
  top: 0px;
  bottom: 0px;
  right: 0px;
  left: 0px;
  z-index: 5;
  opacity: 0.8;
  background-color: white;
  text-align: center;
  padding: 2em 0.2em 1.5em 0.2em;
}
.stashThumbnail .overlay i {
  font-size: 2em;
}
.overlayed .stashThumbnail .overlay {
  z-index: 20;
}
.stashThumbnail .overlay .btn-action {
  display: none;
  cursor: pointer;
  margin: auto;
}
/* On selection hide spinner and show check icon. */
.selected .stashThumbnail .overlay .icon-spinner {
  display: none;
}
.selected .stashThumbnail .overlay .btn-action {
  display: block;
}
.selected .stashThumbnail .overlay .icon-action:before {
  content: "\f046";
}
/* On remove hide spinner and show remove icon. */
.removed .stashThumbnail .overlay .icon-spinner {
  display: none;
}
.removed .stashThumbnail .overlay .btn-action {
  display: block;
}
.removed .stashThumbnail .overlay .icon-action:before {
  content: "\f057";
}
.rotatingLeft .stashThumbnail .overlay .icon-spinner,
.rotatingRight .stashThumbnail .overlay .icon-spinner {
  color: orange;
}
.stashThumbnail .title {
  cursor: default;
  display: none;
  position: absolute;
  top: 0px;
  right: 0px;
  left: 0px;
  height: 10em;
  z-index: 20;
  background-color: white;
  text-align: center;
  padding: 2em 0.2em 1.5em 0.2em;
}
.stashThumbnail .buttonBar {
  cursor: default;
  display: none;
  position: absolute;
  bottom: 0px;
  width: 100%;
  z-index: 20;
  background-color: white;
  text-align: center;
  padding: 2em 0.2em 1.5em 0.2em;
  /*color: #007dbc;*/
}
.stashPicture:not(.selected):not(.removed):not(.overlayed) .stashThumbnail:HOVER .buttonBar {
  display: block;
  background-color: rgba(255,255,255);
  background-color: rgba(255,255,255, 0.7);
  /*border: 5px solid red;*/
}
.stashThumbnail .buttonBar .btn {
  font-size: 1em;
  margin-bottom: 0.5em;
}
.stashThumbnail .buttonBar .icon-large {

}
</style>


<container xmlns:ng="http://angularjs.org" ng-app="soClean">
    <div ng-controller="soCleanLandingPage">
        <div>
            <p>{{locale}}</p>
            <p>{{type}}</p>
            <p>{{service}}</p>
            <p>{{serviceSingle}}</p>
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
