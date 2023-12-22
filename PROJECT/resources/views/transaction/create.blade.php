<form method="post" action="{{route('transaction.store')}}">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Amount</label>
      <input type="text" name="order_amount" class="form-control"  placeholder="Enter amount">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">User Id</label>
      <input type="text" name="user_id" class="form-control"  placeholder="User Id">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
