

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top overflow-hidden" id="head">
        <a class="navbar-brand text-light" href="/Parth/29-01-21/" id="brand">Student Website</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse"  aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse justify-content-end">
            <div class="navbar-nav">
                <div class="nav-item">
                    <a class="nav-link" href="/Parth/29-01-21/">Home <span class="sr-only">(current)</span></a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/Parth/29-01-21/#about">About</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/Parth/29-01-21/#gallery">Gallery</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/Parth/29-01-21/#users">User Details</a>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Blog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/Parth/29-01-21/blog/">Blogs</a>
                    <a class="dropdown-item" href="/Parth/29-01-21/blog/?val=mblogs">My Blogs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/Parth/29-01-21/uploadBlog/">Upload Blog</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/Parth/29-01-21/#contact">Contact</a>
                </div>
                <?php
                if(isset($userEmail) and isset($userId)){
                    ?>
                    <div class='nav-item'>
                        <a class="nav-link " disabled><?php $result = $conn->getData($userId); echo $result[0]['name']; ?></a>
                    </div>

                    <div class='nav-item'>
                        <a class='nav-link btn btn-success text-white mx-1' href='/Parth/29-01-21/logout.php'>Logout</a>
                    </div>
                    <?php
                }
                ?>
                <div class="nav-item dropdown">
                    <select id="dropdownbtn"  onchange="changeTheme(this.value)" class="btn btn-light dropdown-toggle btnTheme" aria-expanded="true"
                            aria-haspopup="true" data-toggle="dropdown">Select Field
                        <div class="dropdown-menu" aria-labelledby="dropdownbtn">
                            <option class="dropdown-item"  value="light">Light Theme</option>
                            <option class="dropdown-item"  value="dark" >Dark Theme</option>
                        </div>
                    </select>
                </div>
            </div>
        </div>
    </nav>