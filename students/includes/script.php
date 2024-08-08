<!DOCTYPE html>


<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('content').classList.toggle('active');
    }

    function setGridView() {
        document.querySelector('.project-container').classList.add('grid-view');
        document.querySelector('.project-container').classList.remove('list-view');
    }

    function setListView() {
        document.querySelector('.project-container').classList.add('list-view');
        document.querySelector('.project-container').classList.remove('grid-view');
    }

    function setUpcomingView() {
        const now = new Date().toISOString().split('T')[0];
        filterProjects(project => project.dataset.startDate > now);
    }

    function setCompletedView() {
        const now = new Date().toISOString().split('T')[0];
        filterProjects(project => project.dataset.endDate < now);
    }

    function filterProjects(condition) {
        const projects = document.querySelectorAll('.project-card');
        projects.forEach(project => {
            if (condition(project)) {
                project.style.display = 'block';
            } else {
                project.style.display = 'none';
            }
        });
    }

    function resetView() {
        const projects = document.querySelectorAll('.project-card');
        projects.forEach(project => {
            project.style.display = 'block';
        });
    }
</script>