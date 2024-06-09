namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function save(User $user);
    public function find($id): ?User;
    public function delete($id): bool;
}
