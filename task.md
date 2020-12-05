## Technical Interview - Laravel Developer

### Task

Write the backend (i.e. API endpoints and functionality) for the Kanban feature.

### Idea

A kanban board is a way to represent tasks in different states. For example a task could be either ‘Planned’, ‘In progress’, ‘Ready for review’ and ‘Completed’. Changing a task's state, is done by dragging and dropping the task, to the appropriate state. The idea here is to allow the library to create task(s) and move the tasks in the Kanban, while recording what is going on in the backend.

### Definition

Task: A task should be represented in a card, and contain the following data:

* Name of the task
* Responsible for the task (possible to choose from a list of all users)
* Description (text field)
* Deadline for completing the task (a date)
* Priority (High, Medium, Low)
* State (The state from the kanban board)

### Kanban board:

* Ability to create and delete a State (like Unscheduled, On hold, In progress etc)
* Possibility to move states around i.e. the order of the state
* Possibility to create a new task in a state
* Possibility to move a task to another state

### Implementation

Your solution should be implemented in PHP, using Laravel, and MySQL or PostgreSQL as a database (we use MySQL).
We do not expect your solution to contain any front-end code. You can imagine that the API endpoints you create will be provided to another developer and consumed by a front-end application. All your responses should return json.
Your solution will probably end up containing a few database tables, models, controllers to support about 10  endpoints.
We would appreciate you writing one or two tests for parts you think makes most sense to test, but we don’t expect you to write tests for everything.

If you think this is too time-consuming, feel free to leave out parts that you think are less important and write a note on the things you’ve left out.
