# The Kiplin Backend Technical Test (or KBTT)

Welcome to this test!

## Context
This is a todo-list application, which is using the hexagonal architecture.

If this is the first time you hear about this architecural pattern, it aims to separate domain concepts (related to the business) from infrastructure concerns (related to technical details).

The rules of this pattern are:
  - no code living in the `Domain` namespace MUST depend on external system (filesystem, clock, network, ...)
  - no code living in the `Domain` namespace MUST be context specific (can only run in a web or a cli context, for instance)
  - code that requires the previous rules MUST live in the `Infrastructure` namespace
  - `Domain` classes MUST NOT depend on `Infrastructure` classes
  - `Infrastructure` classes CAN depend on `Domain` classes

Furthermore, we have choosen to split read and write concerns (aka the CQRS pattern) by defining multiple repository interfaces. Check the `App\Domain\TodoRepository` and `App\Application\TodosRepository` to learn more about their contract.

However, you may implement both interfaces within the same class.

## Running the app
For now, the app has no contact with the outside world (no shiny UI, no fancy responsive design, ...).

However, you may test your implementations thanks to carefully designed integration tests.

To launch the test suite, you need to run

```
$ make test
```

## Mission
Your mission, should you decide to accept it, is to implement a read and a write repository with the backend storage technology of your choice. It could be, but is not limited to, a RDBMS.

We provide you with in-memory implementations, as an example!

You will use git to log the history of your implementation.

The testsuite must pass by simply running `make all`.

You will add a README explaining your storage choice, along with any modifications or suggestions you have or would have done to the codebase.

At the end of the exercise, archive your whole project, including the `.git` directory and excluding the `vendor` directory.

You may now send it to your Kiplin contact, and we will get in touch soon!

Thanks!