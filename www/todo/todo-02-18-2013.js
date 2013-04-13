// JavaScript Document



$(function(){
	
	var obj = {description: 'Pick up milk!', status: 'incomplete', id:'73494398182b11e2ad9f5404a67007de'};
	
var obj2 = [{description: 'Pick up milk.', status: 'incomplete'},
{description: 'Get a car wash', status: 'incomplete'},
{description: 'Learn Backbone', status: 'incomplete'}
];
	//console.log(obj);
	
	var Todo = Backbone.Model.extend({
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
				console.log(this.toJSON());
				this.save();
			}
		});
	
	var todo = new Todo(obj);
	//todo.fetch();
	
	
	
	var TodoList = Backbone.Collection.extend({
			model: todo,
			url: "../api/s/todo"
		});
	var todoList = new TodoList();	
	console.log(todoList.length);	
		
	
	var TodoListView = Backbone.View.extend({});
	
	var TodoListItemView = Backbone.View.extend({});


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
		},
		remove: function(){
			this.$el.remove();	
		}	
	});
	
	var todoView = new TodoView({model: todo});
	todoView.render();
	console.log(todoView.el);
	var todoListView = new TodoListView({collection: todoList});
	
	$(todoView.el).appendTo("#app");
	
	
	
	
	
	

});// JavaScript Document