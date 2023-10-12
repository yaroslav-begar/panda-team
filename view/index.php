<div class="container">
    <p>welcome to our survey service!</p>
    <?php if (isset($_SESSION['user'])): ?>
        <h3>Proceed to the cabinet</h3>
        <div>
            <div>
                <a href='/survey/all'><button>Cabinet</button></a>
            </div>
        </div>
    <?php else: ?>
        <h3>Choose an action</h3>
        <div>
            <div>
                <a href='/user/login'><button>Login</button></a>
            </div>
            <div>
                <a href='/user/register'><button">Register</button></a>
            </div>
        </div>
    <?php endif; ?>
</div>
