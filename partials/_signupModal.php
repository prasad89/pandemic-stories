<!--Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup to Forum Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Pandemic-stories/partials/_handleSignup.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input style="color:black;" type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input style="color:black;" type="password" class="form-control" id="signupPassword" name="signupPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input style="color:black;" type="password" class="form-control" id="signupcPassword" name="signupcPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>