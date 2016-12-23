<a class="navbar-brand" href="/">Navbar</a>

<button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsingNavbar" aria-controls="collapsingNavbar" aria-expanded="false" aria-label="Toggle navigation"></button>

<button id="topCardBtn" class="btn btn-outline-success float-xs-right" type="button">
    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
    <span id="topCardContent"></span>
</button>

<div class="collapse navbar-toggleable-md" id="collapsingNavbar">
    <ul class="nav navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE;?>">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/product">Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/list">List</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="topNavDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="topNavDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
    </ul>
    <form class="form-inline float-xs-right">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        </div>
    </form>
</div>

