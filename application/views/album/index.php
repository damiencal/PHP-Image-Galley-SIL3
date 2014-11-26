<container xmlns:ng="http://angularjs.org" ng-app="soClean">
    <div ng-controller="soCleanLandingPage">
        <div>
            <p>{{name}}</p>
            <img src="{{path}}"/>

        </div>
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
