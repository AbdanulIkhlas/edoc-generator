import { motion } from "framer-motion";
import { ArrowUpRight, Github, ExternalLink } from "lucide-react";
import { Link } from "react-router-dom";
import type { Project } from "@/data/projects";
import Badge from "@/components/atoms/Badge";

interface ProjectCardProps {
  project: Project;
  index: number;
}

const ProjectCard = ({ project, index }: ProjectCardProps) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.5 }}
      className="group"
    >
      <Link to={`/projects/${project.id}`}>
        <div className="relative h-full p-6 rounded-2xl bg-card border border-border hover:border-primary/30 transition-all hover:shadow-lg overflow-hidden">
          {/* Featured indicator */}
          {project.featured && (
            <div className="absolute top-4 right-4">
              <Badge variant="primary">Featured</Badge>
            </div>
          )}

          {/* Content */}
          <div className="space-y-4">
            <div className="flex items-center gap-2 text-sm text-muted-foreground">
              <span>{project.year}</span>
              <span className="text-border">•</span>
              <span>{project.role}</span>
            </div>

            <h3 className="text-xl font-heading font-semibold text-foreground group-hover:text-primary transition-colors">
              {project.title}
            </h3>

            <p className="text-muted-foreground text-sm leading-relaxed">
              {project.shortDescription}
            </p>

            <div className="flex flex-wrap gap-2">
              {project.technologies.slice(0, 4).map((tech) => (
                <Badge key={tech} variant="outline">{tech}</Badge>
              ))}
            </div>

            {/* Links */}
            <div className="flex items-center gap-4 pt-2">
              {project.links.github && (
                <a
                  href={project.links.github}
                  target="_blank"
                  rel="noopener noreferrer"
                  onClick={(e) => e.stopPropagation()}
                  className="text-muted-foreground hover:text-foreground transition-colors"
                >
                  <Github size={18} />
                </a>
              )}
              {project.links.live && (
                <a
                  href={project.links.live}
                  target="_blank"
                  rel="noopener noreferrer"
                  onClick={(e) => e.stopPropagation()}
                  className="text-muted-foreground hover:text-foreground transition-colors"
                >
                  <ExternalLink size={18} />
                </a>
              )}
              <motion.div
                className="ml-auto text-muted-foreground group-hover:text-primary transition-colors"
                whileHover={{ x: 2, y: -2 }}
              >
                <ArrowUpRight size={20} />
              </motion.div>
            </div>
          </div>
        </div>
      </Link>
    </motion.div>
  );
};

export default ProjectCard;
