import { useState } from "react";
import { motion } from "framer-motion";
import SectionHeading from "@/components/atoms/SectionHeading";
import ProjectCard from "@/components/molecules/ProjectCard";
import { projects, projectsContent } from "@/data/projects";

const ProjectsSection = () => {
  const [activeFilter, setActiveFilter] = useState<string>("all");

  const categories = ["all", "web-app", "design-system", "creative", "open-source"] as const;

  const filteredProjects = activeFilter === "all"
    ? projects
    : projects.filter((project) => project.category === activeFilter);

  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <SectionHeading
          title={projectsContent.heading}
          subtitle={projectsContent.subheading}
        />

        {/* Filter */}
        <div className="flex flex-wrap gap-3 mb-10">
          {categories.map((category) => (
            <motion.button
              key={category}
              onClick={() => setActiveFilter(category)}
              className={`px-4 py-2 rounded-full text-sm font-medium transition-colors ${
                activeFilter === category
                  ? "bg-primary text-primary-foreground"
                  : "bg-secondary text-muted-foreground hover:text-foreground"
              }`}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              {projectsContent.filterLabels[category as keyof typeof projectsContent.filterLabels]}
            </motion.button>
          ))}
        </div>

        {/* Projects Grid */}
        <motion.div 
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
          layout
        >
          {filteredProjects.map((project, index) => (
            <ProjectCard key={project.id} project={project} index={index} />
          ))}
        </motion.div>
      </div>
    </section>
  );
};

export default ProjectsSection;
