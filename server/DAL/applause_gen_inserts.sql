INSERT INTO commands (commandId, eventId, text, usergroup, seatrow, execution) VALUES
(1, 2, 'coffe break ', 'f', 'a', '2021-06-21 23:01:44'),
(2, 0, 'laugh', 'f', 'a', '2021-06-22 01:09:25'),
(3, 2, 'cheer!', 'm', 'a', '2021-06-22 02:34:34');

INSERT INTO events (eventId, eventName, date) VALUES
(1, 'watch a movie', '2021-06-23'),
(2, 'new event', '2021-06-09');

INSERT INTO userevents (userEventsId, eventId, userId, reservedSeatId) VALUES
(1, 2, 1, 'A4'),
(2, 1, 2, 'B4'),
(3, 2, 3, 'B5');

INSERT INTO users (userId, username, age, gender, role, rating, password) VALUES
(1, 'lnpavlova', 22, 'f', 'user', 30, '$2y$12$h3asoAQk2bm558xYvh7eyuTatc/ymhUIlRS2fphbb2rwTff3KINuK'),
(2, 'peter', 23, 'm', 'user', 10, '$2y$12$.QENBp2Id901UguNpLdTkONYnxI83tnZGEpVE2efBlqqecou3V8vK'),
(3, 'georgi', 20, 'm', 'user', 0, '$2y$12$yx7anGWN/Oi.pfsyrYtkue6yKaPFUQMsNR4YPBxxQ17dMy87xPrr2'),
(4, 'admin', 50, 'f', 'admin', 0, '$2y$12$RrH88Cq8uplWbo1VahZQh.FOR7aOuwo4f5lo9Tk.6wy7Gn6AsGfV2');
