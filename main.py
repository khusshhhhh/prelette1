# To-Do List Manager

def display_menu():
    print("\n=== To-Do List Menu ===")
    print("1. View To-Do List")
    print("2. Add Task")
    print("3. Remove Task")
    print("4. Mark Task as Completed")
    print("5. Exit")

def view_tasks(tasks):
    if not tasks:
        print("\nYour to-do list is empty.")
        return

    print("\n=== Your To-Do List ===")
    for idx, (task, completed) in enumerate(tasks, start=1):
        status = "Done" if completed else "Pending"
        print(f"{idx}. {task} [{status}]")

def add_task(tasks):
    task = input("\nEnter the task to add: ").strip()
    if task:
        tasks.append((task, False))
        print(f"Task '{task}' added successfully!")
    else:
        print("Invalid task. Please try again.")

def remove_task(tasks):
    if not tasks:
        print("\nYour to-do list is empty. Nothing to remove.")
        return

    view_tasks(tasks)
    try:
        index = int(input("\nEnter the number of the task to remove: ")) - 1
        if 0 <= index < len(tasks):
            removed_task = tasks.pop(index)
            print(f"Task '{removed_task[0]}' removed successfully!")
        else:
            print("Invalid task number. Please try again.")
    except ValueError:
        print("Invalid input. Please enter a number.")

def mark_task_completed(tasks):
    if not tasks:
        print("\nYour to-do list is empty. Nothing to mark.")
        return

    view_tasks(tasks)
    try:
        index = int(input("\nEnter the number of the task to mark as completed: ")) - 1
        if 0 <= index < len(tasks):
            task, _ = tasks[index]
            tasks[index] = (task, True)
            print(f"Task '{task}' marked as completed!")
        else:
            print("Invalid task number. Please try again.")
    except ValueError:
        print("Invalid input. Please enter a number.")

def main():
    tasks = []
    while True:
        display_menu()
        try:
            choice = int(input("\nEnter your choice: "))
            if choice == 1:
                view_tasks(tasks)
            elif choice == 2:
                add_task(tasks)
            elif choice == 3:
                remove_task(tasks)
            elif choice == 4:
                mark_task_completed(tasks)
            elif choice == 5:
                print("\nExiting To-Do List Manager. Have a great day!")
                break
            else:
                print("Invalid choice. Please select a valid option.")
        except ValueError:
            print("Invalid input. Please enter a number.")

if __name__ == "__main__":
    main()
