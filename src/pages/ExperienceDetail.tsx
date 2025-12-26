import { useParams, Link } from "react-router-dom";
import { motion } from "framer-motion";
import { ArrowLeft, Calendar, MapPin, Users, ExternalLink } from "lucide-react";
import MainLayout from "@/layouts/MainLayout";
import Badge from "@/components/atoms/Badge";
import { experiences } from "@/data/experience";

const ExperienceDetail = () => {
  const { slug } = useParams();
  const experience = experiences.find((e) => e.id === slug);

  if (!experience) {
    return (
      <MainLayout>
        <div className="py-24 text-center">
          <h1 className="text-2xl font-heading font-bold text-foreground mb-4">
            Experience not found
          </h1>
          <Link to="/experience" className="text-primary">
            ← Back to experience
          </Link>
        </div>
      </MainLayout>
    );
  }

  return (
    <MainLayout>
      <section className="py-24 bg-background">
        <div className="container mx-auto px-6">
          <div className="max-w-3xl mx-auto">
            {/* Back link */}
            <motion.div
              initial={{ opacity: 0, x: -20 }}
              animate={{ opacity: 1, x: 0 }}
              className="mb-8"
            >
              <Link
                to="/experience"
                className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors"
              >
                <ArrowLeft size={18} />
                Back to experience
              </Link>
            </motion.div>

            {/* Header */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              className="mb-12"
            >
              <div className="flex flex-wrap items-center gap-3 text-sm text-muted-foreground mb-4">
                <div className="flex items-center gap-1">
                  <Calendar size={14} />
                  <span>{experience.period}</span>
                </div>
                <span className="text-border">•</span>
                <div className="flex items-center gap-1">
                  <MapPin size={14} />
                  <span>{experience.location}</span>
                </div>
                {experience.teamSize && (
                  <>
                    <span className="text-border">•</span>
                    <div className="flex items-center gap-1">
                      <Users size={14} />
                      <span>{experience.teamSize}</span>
                    </div>
                  </>
                )}
              </div>

              <h1 className="text-3xl md:text-4xl font-heading font-bold text-foreground mb-2">
                {experience.role}
              </h1>
              <div className="flex items-center gap-2">
                <span className="text-xl text-primary font-medium">
                  {experience.company}
                </span>
                {experience.companyUrl && (
                  <a
                    href={experience.companyUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="text-muted-foreground hover:text-foreground"
                  >
                    <ExternalLink size={16} />
                  </a>
                )}
              </div>
            </motion.div>

            {/* Description */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.1 }}
              className="mb-10"
            >
              <p className="text-lg text-muted-foreground leading-relaxed">
                {experience.description}
              </p>
            </motion.div>

            {/* Technologies */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.2 }}
              className="mb-10"
            >
              <h3 className="text-lg font-heading font-semibold text-foreground mb-4">
                Technologies
              </h3>
              <div className="flex flex-wrap gap-2">
                {experience.technologies.map((tech) => (
                  <Badge key={tech}>{tech}</Badge>
                ))}
              </div>
            </motion.div>

            {/* Responsibilities */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.3 }}
              className="mb-10"
            >
              <h3 className="text-lg font-heading font-semibold text-foreground mb-4">
                Responsibilities
              </h3>
              <ul className="space-y-3">
                {experience.responsibilities.map((item, index) => (
                  <li key={index} className="flex items-start gap-3">
                    <span className="w-1.5 h-1.5 rounded-full bg-primary mt-2 shrink-0" />
                    <span className="text-muted-foreground">{item}</span>
                  </li>
                ))}
              </ul>
            </motion.div>

            {/* Achievements */}
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.4 }}
              className="p-6 rounded-2xl bg-card border border-border"
            >
              <h3 className="text-lg font-heading font-semibold text-foreground mb-4">
                Key Achievements
              </h3>
              <ul className="space-y-3">
                {experience.achievements.map((item, index) => (
                  <li key={index} className="flex items-start gap-3">
                    <span className="text-primary mt-0.5">✓</span>
                    <span className="text-foreground">{item}</span>
                  </li>
                ))}
              </ul>
            </motion.div>
          </div>
        </div>
      </section>
    </MainLayout>
  );
};

export default ExperienceDetail;
