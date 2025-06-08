<!DOCTYPE html>
<html>

<head>
    <title>Ticket Assigned</title>
</head>

<body>
    <h2>Hello {{ $ticket->assignedTo->name }},</h2>
    <p>You have been assigned to a new ticket with ID: <strong>{{ $ticket->id }}</strong>.</p>
    <p>Title: {{ $ticket->title }}</p>
</body>

</html>