<?php
class WorkModel extends DB
{
    public function callSelectQuery($query)
    {
        return mysqli_query($this->con, $query);
    }

    public function callActionQuery($query, $action, $data = [], $id = '')
    {
        $stmt = $this->con->prepare($query);

        if (!$stmt) {
            die('prepare failed: ' . htmlspecialchars($this->con->error));
        }

        if (count($data) > 0) {
            $name = $data['name'];
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
            $status = $data['status'];

            if ($action == 'update') {
                $stmt->bind_param('ssssi', $name, $start_date, $end_date, $status, $id);
            } else if ($action == 'create') {
                $stmt->bind_param('ssss', $name, $start_date, $end_date, $status);
            }
        }

        if ($action == 'delete') {
            $stmt->bind_param('i', $id);
        }

        $result = $stmt->execute();

        if (!$result) {
            die('execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    public function getWork()
    {
        $query = "SELECT * FROM works";

        return $this->callSelectQuery($query);
    }

    public function findOrFail($id)
    {
        $query = "SELECT * FROM works WHERE `id` = $id";
        $work = [];
        $result = $this->callSelectQuery($query);

        if ($result->num_rows > 0) {
            $work = mysqli_fetch_array($result);

            return $work;
        }

        return $work;
    }

    public function create($data)
    {
        $query = "INSERT INTO works (name, start_date, end_date, status) VALUES (?, ?, ?, ?)";

        return $this->callActionQuery($query, 'create', $data);
    }

    public function update($data, $id)
    {
        $query = "UPDATE works
            SET `name` = ?,
                `start_date` = ?,
                `end_date` = ?,
                `status` = ?
            WHERE id = ?";

        $this->callActionQuery($query, 'update', $data, $id);
    }

    public function delete($id)
    {
        $query = "DELETE FROM `works` WHERE id = ?";

        $this->callActionQuery($query, 'delete', [], $id);
    }
}
