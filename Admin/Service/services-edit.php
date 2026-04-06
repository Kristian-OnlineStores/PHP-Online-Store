<?php
require_once __DIR__ . '/../includes/header.php';

// Проверка дали има ID за редактиране
if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect('services.php', 'error', 'No service ID provided.');
}

$serviceId = $_GET['id'];

// Вземане на данните на услугата от базата данни
$serviceData = getById('services', $serviceId);

if (!$serviceData) {
    redirect('services.php', 'error', 'Service not found.');
}

$service = $serviceData['data'];
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Service
                    <a href="services.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>

                 

                <form action="../code.php" method="POST">

                    <input type="hidden" name="serviceId" value="<?= $service['id'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($service['name']) ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($service['description']) ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status </label>
                                <br/>
                                <input type="checkbox" name="status" value="1" style="width:30px; height:30px;" <?= isset($service['status']) && $service['status'] == 1 ? 'checked' : '' ?>>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3 text-end">
                                <br>
                                <button type="submit" name="updateService" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>