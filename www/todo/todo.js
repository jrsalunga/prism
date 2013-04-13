// JavaScript Document



$(function(){
	
	var obj = {description: 'Pick up milk!', status: 'incomplete'};
	
var obj2 = [	
			{description: 'Pick up milk.', status: 'incomplete', id:'73494398182b11e2ad9f5404a67007de'},
		  	{description: 'Get a car wash', status: 'incomplete', id:'73494398182b11e2ad9f5404a67007da'},
		  	{description: 'Study Backbone', status: 'incomplete', id:'3E63899EB7ED45D799BAEDA2FC75DF2F'}
		 ];
	//console.log(obj);
	
	var Todo = Backbone.Model.extend({
			//idAttribute: "id",
			urlRoot: "../api/s/todo",
			initialize: function(){
				console.log(this.toJSON());
			},
			toggleStatus: function(){
				if(this.get('status') === 'incomplete'){
					this.set({'status': 'complete'});
				}else{			
					this.set({'status': 'incomplete'});
				}
				//console.log(this.toJSON());
				this.save();
			}
		});
	
	var todo = new Todo(obj);
	//todo.fetch();
	
	
	
	var TodoList = Backbone.Collection.extend({
			model: Todo,
			url: "../api/s/todo"
		});
	//var todoList = new TodoList();	
	//todoList.fetch();
	//console.log(todoList.length);	
		
	
	var TodoListView = Backbone.View.extend({
		tagName:'ul',
    	initialize:function () {
			this.collection.on('reset', this.addAll, this);  
			this.collection.on('add', this.addOne, this);      	
		},
		render:function () {
			this.addAll();
   		},
		addOne: function(todo){
			var todoListItemView = new TodoListItemView({model: todo});
			this.$el.append(todoListItemView.render().el);
		},
		addAll: function(){
			this.collection.forEach(this.addOne, this);
		}
	});
	
	var TodoListItemView = Backbone.View.extend({
		tagName:"li",
		initialize: function(){
			this.model.on('change', this.render, this);	
			this.model.on('destroy', this.remove, this);
		},
		events:{
			'change input': 'toggleStatus'	
		},
		toggleStatus: function(){
			this.model.toggleStatus();
		},
		template: _.template('<h3 class="<%=status%>">'+
			'<input type="checkbox" '+
			'<% if(status==="complete") print("checked") %> />' +
			'<%=description%></h3>'),
	    render: function() {
	        this.$el.html(this.template(this.model.toJSON()));
	        return this;
	    }
	});


	var TodoView = Backbone.View.extend({
		template: _.template('<h3 class="<%=status%>">'+
			'<input type="checkbox" '+
			'<% if(status==="complete") print("checked") %> />' +
			'<%=description%></h3>'),
		events:{
			'change input': 'toggleStatus'	
		},
		initialize: function(){
			this.model.on('change', this.render, this);	
			this.model.on('destroy', this.remove, this);
		},
		toggleStatus: function(){
			this.model.toggleStatus();
		},
		render: function(){
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		},
		remove: function(){
			this.$el.remove();	
		}	
	});
	
	var todoView = new TodoView({model: todo});
	todoView.render();
	console.log(todoView.el);
	
	$(todoView.el).appendTo("#app");
	
	
	
	
	var todoList = new TodoList();
	todoList.fetch();
	//todoList.reset(obj2);	
	//var newTodoItem = new Todo({description: 'Get a car wash', status: 'incomplete', id:'73494398182b11e2ad9f5404a67007da'});
	//todoList.create({description: 'Get a car wash', status: 'incomplete', id:'73494398182b11e2ad9f5404a67007da'});
	var todoListView = new TodoListView({collection: todoList});
	todoListView.render();
	console.log(todoList);
	$(todoListView.el).appendTo("#list");
	
	
	
	
	
	

});// JavaScript Document