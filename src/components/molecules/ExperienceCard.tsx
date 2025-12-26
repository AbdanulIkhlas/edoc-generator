import { motion } from "framer-motion";
import { ArrowRight, MapPin, Calendar } from "lucide-react";
import { Link } from "react-router-dom";
import type { Experience } from "@/data/experience";
import Badge from "@/components/atoms/Badge";

interface ExperienceCardProps {
  experience: Experience;
  index: number;
}

const ExperienceCard = ({ experience, index }: ExperienceCardProps) => {
  return (
    <motion.div
      initial={{ opacity: 0, x: -20 }}
      whileInView={{ opacity: 1, x: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.5 }}
      className="group"
    >
      <Link to={`/experience/${experience.id}`}>
        <div className="relative p-6 rounded-2xl bg-card border border-border hover:border-primary/30 transition-all hover:shadow-lg">
          <div className="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div className="flex-1">
              <div className="flex items-center gap-2 text-sm text-muted-foreground mb-2">
                <Calendar size={14} />
                <span>{experience.period}</span>
                <span className="text-border">•</span>
                <MapPin size={14} />
                <span>{experience.location}</span>
              </div>
              
              <h3 className="text-xl font-heading font-semibold text-foreground group-hover:text-primary transition-colors mb-1">
                {experience.role}
              </h3>
              <p className="text-primary font-medium mb-3">{experience.company}</p>
              
              <p className="text-muted-foreground text-sm leading-relaxed mb-4">
                {experience.description}
              </p>

              <div className="flex flex-wrap gap-2">
                {experience.technologies.slice(0, 4).map((tech) => (
                  <Badge key={tech} variant="outline">{tech}</Badge>
                ))}
                {experience.technologies.length > 4 && (
                  <Badge variant="outline">+{experience.technologies.length - 4}</Badge>
                )}
              </div>
            </div>

            <motion.div
              className="flex items-center justify-center w-10 h-10 rounded-full bg-secondary group-hover:bg-primary/10 transition-colors"
              whileHover={{ x: 4 }}
            >
              <ArrowRight size={18} className="text-muted-foreground group-hover:text-primary transition-colors" />
            </motion.div>
          </div>
        </div>
      </Link>
    </motion.div>
  );
};

export default ExperienceCard;
