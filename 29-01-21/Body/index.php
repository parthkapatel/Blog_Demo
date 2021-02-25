<div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 img-fluid" src="assets/img/sigmund-HsTnjCVQ798-unsplash.jpg" style="width:100%;height:650px;" alt="Images">
            <div class="carousel-caption d-none d-md-block">
                <h5>Planning</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" src="assets/img/thumbnail-image.jpg" style="width:100%;height:650px;" alt="Images">
            <div class="carousel-caption d-none d-md-block">
                <h5>House</h5>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" data-slide="prev" role="button">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" data-slide="next" role="button">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="jumbotron rounded-0 clearfix w-100 m-0 about" id="about" >
    <h1 class="h1 text-center">About Us</h1>
    <div class="col-lg-4 col-md-12 float-lg-right">
        <img src="assets/img/thumbnail-image.jpg" class="img-fluid rounded" alt="image">
    </div>
    <div class="col-lg-8 col-md-12 float-lg-right">
        <p class="lead text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the
            <strong>1500s</strong>, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five
            centuries, but also the leap into electronic typesetting, remaining essentially
            unchanged. It was popularised in the <del>1960s</del><ins>1965s</ins> with the
            release of Letraset sheets containing Lorem Ipsum passages, and more recently
            with desktop publishing software like Aldus PageMaker including versions of
            Lorem Ipsum.
        </p>
    </div>
</div>

<div class="container-fluid m-0" id="gallery" onclick="call(this.id)">
    <h1 class="h1 text-center p-3">Gallery</h1>
    <div class="row p-3">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
    </div>

    <div class="row p-3">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="assets/img/thumbnail-image.jpg" id="img" class="img-thumbnail rounded" alt="image">
        </div>
    </div>
</div>

<div class="container-fluid p-5 w-100 bg-info" id="users">
    <h1 class="h1 text-center">User Details</h1>
    <div class="container-fluid">

        <div class="table-responsive">
            <table class="table table-hover table-light usersTable">
                <?php $data = $conn->getData($userId); ?>
                <thead class="thead usersTable-head">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <!--<th>Password</th>-->
                    <th>Contact No.</th>
                    <th>Update Profile</th>
                    <th>Delete Profile</th>
                </tr>
                </thead>
                <tbody class="tbody usersTable-body">
                <?php
                if(count($data) > 0){
                    foreach ($data as $value){
                        echo "<tr>
                                                <td>".$value['id']."</td>
                                                <td>".$value['name']."</td>
                                                <td>".$value['gender']."</td>
                                                <td>".$value['email']."</td>
                                                <!--<td>".$value['password']."</td>-->
                                                <td>".$value['phone']."</td>
                                                <td><a href='index.php?id=".$value['id']."' class='btn btn-primary'>Update</a></td>
                                                <td><a href='home.php?del=".$value['id']."' class='btn btn-primary'>Delete</a></td>
                                          </tr>";
                    }
                }else{
                    echo "<tr><td><h2 class='text-warning'>No Data Found</h2></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid card-group p-5">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card rounded usersCard">
                    <img src="assets/img/sigmund-HsTnjCVQ798-unsplash.jpg" width="100%" height="200px" class="card-img-top rounded" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title">
                            Places
                        </h5>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                    </div>
                    <div class="card-footer"><h6>Footer</h6></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card rounded usersCard">
                    <img src="assets/img/sigmund-HsTnjCVQ798-unsplash.jpg" width="100%" height="200px" class="card-img-top rounded" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">
                            Places
                        </h5>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                    </div>
                    <div class="card-footer"><h6>Footer</h6></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card rounded usersCard">
                    <img src="assets/img/sigmund-HsTnjCVQ798-unsplash.jpg" width="100%" height="200px" class="card-img-top rounded" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">
                            Places
                        </h5>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                    </div>
                    <div class="card-footer"><h6>Footer</h6></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card rounded usersCard">
                    <img src="assets/img/sigmund-HsTnjCVQ798-unsplash.jpg" width="100%" height="200px" class="card-img-top rounded">
                    <div class="card-body">
                        <h5 class="card-title">
                            Places
                        </h5>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                        <p class="card-text">This is the paragraph.</p>
                    </div>
                    <div class="card-footer"><h6>Footer</h6></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-3 contact" id="contact">
    <h1 class="h1 text-center p-3">Contact Us</h1>
    <div class="container row bg-dark rounded mx-auto p-3 contact-body">
        <div class="container-fluid text-white col-md-12 col-lg-6">
            <h4>Address :</h4>
            <p class="lead"><pre class="initialism text-white">
            B-418, Kutbi Sheri,
            Moti Vhorvad,
            Kapadwanj - 387620,
            Gujarat, India.

        Contact : <a class="text-white" href="tel:+919924104072">+91-99241040721</a>(Mobile Phone , Whatsapp)
                  <a class="text-white" href="tel:+918980407187">+91-8980407187</a>(Mobile Phone)
            </pre>

        </div>

        <div class="container-fluid text-white col-md-12 col-lg-6">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="name" class="h5">Name :</label>
                    <input type="text" class="form-control w-75" name="name" placeholder="Enter Name...">
                </div>
                <div class="form-group">
                    <label for="email" class="h5">Email :</label>
                    <input type="email" class="form-control w-75" name="email" placeholder="Enter Email...">
                </div>
                <div class="form-group">
                    <label for="file" class="h5">Description :</label>
                    <textarea rows="5" class="form-control w-75" name="description" placeholder="Enter your purpose..." cols="20"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block w-75" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>