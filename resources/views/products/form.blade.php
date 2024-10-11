<form>

    <div class="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" />
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Price" />
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Quantity" />
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" placeholder="Slug" />
        </div>
        <div class="form-group">
            <label for="photo">Product picture</label>
            <input type="file" class="form-control" id="photo" />
        </div>
        <div class="form-group">
            <label for="category">Category ID</label>
            <select class="form-control" id="category">
                <option value="">Select Category</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subcategory">Subcategory ID</label>
            <select class="form-control" name="subcategory_id" id="subcategory">
                <option value="">Select Subcategory</option>
                @foreach ($subcategories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="brand">Brand ID</label>
            <select class="form-control" name="brand_id" id="brand">
                <option value="">Select Brand</option>
                @foreach ($brands as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
