<div class="card offset-3 col-6">
    <div class="card-header">
      Login
    </div>
    <div class="card-body">
       <form wire:submit="loginUser">
            
              
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input wire:model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              <div>@error('email')
                <span class="text-danger" >{{$message}}</span>
               @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input wire:model="password" type="password" class="form-control" id="exampleInputPassword1">
              <div>@error('password')
                <span class="text-danger" >{{$message}}</span>
               @enderror
              </div>
            </div>
            
            <button href="/customer" type="submit" class="btn btn-primary btn-sm">Submit</button>
          </form>

           <div class="mb-3 ">
            Don't have an account ? <button href="/register" class="btn btn-success">Register</button>

           </div>


    </div>
    
  </div>